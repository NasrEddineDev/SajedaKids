<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use Illuminate\Support\Facades\Auth;
use File;
use Storage;
use App\Models\Purchase;
use App\Models\Company;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Store;

class PurchaseController extends Controller
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
            // $purchases = (Auth::User()->role->name == 'user') ? Auth::User()->Enterprise->purchases : Purchase::all();
            $purchases = Purchase::all();
            return view('purchases.index', compact('purchases'));
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
            $companies =  Company::all();
            $stores =  Store::all();
            $categories =  Category::all();
            $brands = Brand::all(); //collect(['shoes', 'veste']);collect(['levis', 'lacoste']);
            return view('purchases.create', compact('companies', 'stores', 'categories', 'brands'));
        } catch (Throwable $e) {
            // report($e);
            // Log::error($e->getMessage());
            return false;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePurchaseRequest $request)
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
            $purchase = new Purchase([
                'SKU' => $request->input('SKU'),
                'name_ar' => $request->input('name_ar') ? $request->input('name_ar') : '',
                'name_en' => $request->input('name_en') ? $request->input('name_en') : '',
                'name_fr' => $request->input('name_fr') ? $request->input('name_fr') : '',
                'brand_id' => $request->input('brand_id') ? $request->input('brand_id') : '',
                'image' => '',
                'active' => true,
                'category_id' => $request->input('category_id') ? $request->input('category_id') : '',
                'code' => $request->input('code') ? $request->input('code') : '',
                'description' => $request->input('description') ? $request->input('description') : '',
                'price' => $request->input('price') ? $request->input('price') : '',
                'discount' => $request->input('discount') ? $request->input('discount') : '',
                'company_id' => Auth::User()->company->id
            ]);
            $purchase->save();

            // if (!file_exists('data/' . $destinationPath)) {
            //     File::makeDirectory('data/' . $destinationPath, $mode = 0777, true, true);
            // }

            $destinationPath = 'companies/' . (Auth::User()->company->id) . '/' . 'purchases/';
            $file = $request->file('image');
            if ($file){
                $fileName = $purchase->id . '.' . $file->getClientOriginalExtension();
                Storage::disk('public')->put($destinationPath . $fileName, file_get_contents($file));
                $purchase->image = $fileName;
                $purchase->update(['image' => $fileName]);
            }

            return redirect()->route('purchases.index')
                ->with('success', 'Purchase created successfully.');
        } catch (Throwable $e) {
            report($e);
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        //
        try {
            $purchase = Purchase::find($id);
            return view('purchases.show', compact('purchase'));
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
            $purchase = Purchase::find($id);
            if ($purchase) {
                $companies =  Company::all();
                $categories =  Category::all();
                $brands = Brand::all();
                return view('purchases.edit', compact('purchase', 'categories', 'brands', 'companies'));
            }
            return redirect()->route('purchases.index')
                ->with('error', 'Purchase can\'t eddited.');
        } catch (Throwable $e) {
            report($e);
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePurchaseRequest $request)
    {
        //
        try {
            $purchase = Purchase::find($request->purchase_id);
            $purchase->SKU = $request->input('SKU');
            $purchase->name_ar = $request->input('name_ar');
            $purchase->name_en = $request->input('name_en');
            $purchase->name_fr = $request->input('name_fr');
            $purchase->description = $request->input('description') ? $request->input('description') : '';
            $purchase->code = $request->input('code') ? $request->input('code') : '';
            $purchase->price = $request->input('price') ? $request->input('price') : '';
            $purchase->discount = $request->input('discount') ? $request->input('discount') : '';
            $purchase->category_id = $request->input('category_id') ? $request->input('category_id') : null;
            $purchase->brand_id = $request->input('brand_id') ? $request->input('brand_id') : null;

            $destinationPath = 'companies/' . (Auth::User()->company->id) . '/' . 'purchases/';
            $file = $request->file('image');
            //to do: delete old image
            if ($file){
                $fileName = $purchase->id . '.' . $file->getClientOriginalExtension();
                Storage::disk('public')->put($destinationPath . $fileName, file_get_contents($file));
                $purchase->image = $fileName;
                $purchase->update(['image' => $fileName]);
            }

            $purchase->save();
            return redirect()->route('purchases.index')
                ->with('success', 'Purchase updated successfully');
        } catch (Throwable $e) {
            report($e);
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        //
        try {
            $purchase = Purchase::find($id);
            if ($purchase) {
                $purchase->delete();
                return response()->json([
                    'message' => 'Purchase deleted successfully'
                ], 200);
            }
            return response()->json([
                'message' => 'Purchase not found'
            ], 404);
        } catch (Throwable $e) {
            report($e);
            Log::error($e->getMessage());

            return false;
        }
    }

    public function getPurchases()
    {
        //
        try {

            $data = [];
            $purchases = (Auth::User()->role->name == 'user') ? Auth::User()->Enterprise->purchases : Purchase::all();

            return response()->json(['purchases' => $purchases]); //->select('id AS value', 'name AS text')]);//->pluck('id' as 'value', 'name' . ' '. 'brand' as 'text')], 404);
        } catch (Throwable $e) {
            report($e);
            Log::error($e->getMessage());

            return false;
        }
    }
}
