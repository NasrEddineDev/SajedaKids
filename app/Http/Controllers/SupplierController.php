<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use Illuminate\Support\Facades\Auth;
use File;
use Storage;
use App\Models\Supplier;
use App\Models\Company;
use App\Models\State;
use App\Models\City;

class SupplierController extends Controller
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
            // $suppliers = (Auth::User()->role->name == 'user') ? Auth::User()->Enterprise->suppliers : Supplier::all();
            $suppliers = Supplier::all();
            return view('suppliers.index', compact('suppliers'));
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
            return view('suppliers.create', compact('states', 'cities'));
        } catch (Throwable $e) {
            // report($e);
            // Log::error($e->getMessage());
            return false;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupplierRequest $request)
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
            $supplier = new Supplier([
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
            $supplier->save();

            // if (!file_exists('data/' . $destinationPath)) {
            //     File::makeDirectory('data/' . $destinationPath, $mode = 0777, true, true);
            // }

            $destinationPath = 'companies/' . (Auth::User()->company->id) . '/' . 'suppliers/';
            $file = $request->file('image');
            if ($file) {
                $fileName = $supplier->id . '.' . $file->getClientOriginalExtension();
                Storage::disk('public')->put($destinationPath . $fileName, file_get_contents($file));
                $supplier->image = $fileName;
                $supplier->update(['image' => $fileName]);
            }

            return redirect()->route('suppliers.index')
                ->with('success', 'Supplier created successfully.');
        } catch (Throwable $e) {
            report($e);
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
        try {
            $supplier = Supplier::find($id);
            return view('suppliers.show', compact('supplier'));
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
            $supplier = Supplier::find($id);
            if ($supplier) {
                $cities = City::where('state_id', '=', $supplier->city->state_id)->orderBy('name_ar')->get();
                $states = State::where('country_id', '=', '4')->orderBy('iso2')->get();
                return view('suppliers.edit', compact('supplier', 'states', 'cities'));
            }
            return redirect()->route('suppliers.index')
                ->with('error', 'Supplier can\'t eddited.');
        } catch (Throwable $e) {
            report($e);
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupplierRequest $request)
    {
        //
        try {
            $supplier = Supplier::find($request->supplier_id);
            $supplier->name_ar = $request->input('name_ar') ? $request->input('name_ar') : '';
            $supplier->name_lt = $request->input('name_lt') ? $request->input('name_lt') : '';
            $supplier->address_ar = $request->input('address_ar') ? $request->input('address_ar') : '';
            $supplier->address_lt = $request->input('address_lt') ? $request->input('address_lt') : '';
            $supplier->mobile = $request->input('mobile') ? $request->input('mobile') : '';
            $supplier->email = $request->input('email') ? $request->input('email') : '';
            $supplier->tel = $request->input('tel') ? $request->input('tel') : '';
            $supplier->city_id = $request->input('city_id') ? $request->input('city_id') : null;
            $supplier->save();
            return redirect()->route('suppliers.index')
                ->with('success', 'Supplier updated successfully');
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
            $supplier = Supplier::find($id);
            if ($supplier) {
                $supplier->delete();
                return response()->json([
                    'done' => true,
                    'message' => 'Supplier deleted successfully'
                ], 200);
            }
            return response()->json([
                'message' => 'Supplier not found'
            ], 404);
        } catch (Throwable $e) {
            report($e);
            Log::error($e->getMessage());

            return false;
        }
    }

    public function getSuppliers()
    {
        //
        try {

            $data = [];
            $suppliers = (Auth::User()->role->name == 'user') ? Auth::User()->Enterprise->suppliers : Supplier::all();

            return response()->json(['suppliers' => $suppliers]); //->select('id AS value', 'name AS text')]);//->pluck('id' as 'value', 'name' . ' '. 'brand' as 'text')], 404);
        } catch (Throwable $e) {
            report($e);
            Log::error($e->getMessage());

            return false;
        }
    }
}
