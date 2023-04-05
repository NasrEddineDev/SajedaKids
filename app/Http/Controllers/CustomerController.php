<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Illuminate\Support\Facades\Auth;
use File;
use Storage;
use App\Models\Customer;
use App\Models\Company;
use App\Models\State;
use App\Models\City;

class CustomerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {
            // $customers = (Auth::User()->role->name == 'user') ? Auth::User()->Enterprise->customers : Customer::all();
            $customers = Customer::all();
            return view('customers.index', compact('customers'));
        } catch (Throwable $e) {
            // report($e);
            // Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        try {
            $state_id = '1106';
            $cities = City::where('state_id', '=', $state_id)->orderBy('name_ar')->get();
            $states = State::where('country_id', '=', '4')->orderBy('iso2')->get();
            return view('customers.create', compact('states', 'cities'));
        } catch (Throwable $e) {
            // report($e);
            // Log::error($e->getMessage());
            return false;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        //
        try {
            // $request->validate(
            //     [
            //         'image' => 'required|max:10240|mimes:doc,pdf,docx,jpeg,jpg,png',
            //     ],
            //     // custom messages
            //     [
            //         'image.required' => __('Image file is required'),
            //     ]
            // );
            $customer = new Customer([
                'name_ar' => $request->input('name_ar') ? $request->input('name_ar') : '',
                'name_lt' => $request->input('name_lt') ? $request->input('name_lt') : '',
                'address_ar' => $request->input('address_ar') ? $request->input('address_ar') : '',
                'address_lt' => $request->input('address_lt') ? $request->input('address_lt') : '',
                'mobile' => $request->input('mobile') ? $request->input('mobile') : '',
                'email' => $request->input('email') ? $request->input('email') : '',
                'tel' => $request->input('tel') ? $request->input('tel') : '',
                'city_id' => $request->input('city_id') ? $request->input('city_id') : '',
                'company_id' => Auth::User()->company->id
            ]);
            $customer->save();

            // if (!file_exists('data/' . $destinationPath)) {
            //     File::makeDirectory('data/' . $destinationPath, $mode = 0777, true, true);
            // }

            $destinationPath = 'companies/' . (Auth::User()->company->id) . '/' . 'customers/';
            $file = $request->file('image');
            if ($file) {
                $fileName = $customer->id . '.' . $file->getClientOriginalExtension();
                Storage::disk('public')->put($destinationPath . $fileName, file_get_contents($file));
                $customer->image = $fileName;
                $customer->update(['image' => $fileName]);
            }

            return redirect()->route('customers.index')
                ->with('success', 'Customer created successfully.');
        } catch (Throwable $e) {
            report($e);
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
        try {
            $customer = Customer::find($id);
            return view('customers.show', compact('customer'));
        } catch (Throwable $e) {
            report($e);
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        try {
            $customer = Customer::find($id);
            if ($customer) {
                $cities = City::where('state_id', '=', $customer->city->state_id)->orderBy('name_ar')->get();
                $states = State::where('country_id', '=', '4')->orderBy('iso2')->get();
                return view('customers.edit', compact('customer', 'states', 'cities'));
            }
            return redirect()->route('customers.index')
                ->with('error', 'Customer can\'t eddited.');
        } catch (Throwable $e) {
            report($e);
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request)
    {
        //
        try {
            $customer = Customer::find($request->customer_id);
            $customer->name_ar = $request->input('name_ar') ? $request->input('name_ar') : '';
            $customer->name_lt = $request->input('name_lt') ? $request->input('name_lt') : '';
            $customer->address_ar = $request->input('address_ar') ? $request->input('address_ar') : '';
            $customer->address_lt = $request->input('address_lt') ? $request->input('address_lt') : '';
            $customer->mobile = $request->input('mobile') ? $request->input('mobile') : '';
            $customer->email = $request->input('email') ? $request->input('email') : '';
            $customer->tel = $request->input('tel') ? $request->input('tel') : '';
            $customer->city_id = $request->input('city_id') ? $request->input('city_id') : null;
            $customer->save();
            return redirect()->route('customers.index')
                ->with('success', 'Customer updated successfully');
        } catch (Throwable $e) {
            report($e);
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        try {
            $customer = Customer::find($id);
            if ($customer) {
                $customer->delete();
                return response()->json([
                    'done' => true,
                    'message' => 'Customer deleted successfully'
                ], 200);
            }
            return response()->json([
                'message' => 'Customer not found'
            ], 404);
        } catch (Throwable $e) {
            report($e);
            Log::error($e->getMessage());

            return false;
        }
    }

    public function getCustomers()
    {
        //
        try {

            $data = [];
            $customers = (Auth::User()->role->name == 'user') ? Auth::User()->Enterprise->customers : Customer::all();

            return response()->json(['customers' => $customers]); //->select('id AS value', 'name AS text')]);//->pluck('id' as 'value', 'name' . ' '. 'brand' as 'text')], 404);
        } catch (Throwable $e) {
            report($e);
            Log::error($e->getMessage());

            return false;
        }
    }
}
