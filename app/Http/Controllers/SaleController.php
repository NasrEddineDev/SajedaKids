<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use Illuminate\Support\Facades\Auth;
use File;
use Storage;
use App\Models\Sale;
use App\Models\Company;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Store;

class SaleController extends Controller
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
            // $sales = (Auth::User()->role->name == 'user') ? Auth::User()->Enterprise->sales : Sale::all();
            $sales = Sale::all();
            return view('sales.index', compact('sales'));
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
            return view('sales.create', compact('companies', 'stores', 'categories', 'brands'));
        } catch (Throwable $e) {
            // report($e);
            // Log::error($e->getMessage());
            return false;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleRequest $request)
    {
        //
        try {
            dd($request->all());
            // $request->validate(
            //     [
            //         'image' => 'required|max:10240|mimes:doc,pdf,docx,jpeg,jpg,png',
            //     ],
            //     // custom messages
            //     [
            //         'image.required' => __('Image file is required'),
            //     ]
            // );
            $sale = new Sale([
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
            $sale->save();

            // if (!file_exists('data/' . $destinationPath)) {
            //     File::makeDirectory('data/' . $destinationPath, $mode = 0777, true, true);
            // }

            $destinationPath = 'companies/' . (Auth::User()->company->id) . '/' . 'sales/';
            $file = $request->file('image');
            if ($file){
                $fileName = $sale->id . '.' . $file->getClientOriginalExtension();
                Storage::disk('public')->put($destinationPath . $fileName, file_get_contents($file));
                $sale->image = $fileName;
                $sale->update(['image' => $fileName]);
            }

            return redirect()->route('sales.index')
                ->with('success', 'Sale created successfully.');
        } catch (Throwable $e) {
            report($e);
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        //
        try {
            $sale = Sale::find($id);
            return view('sales.show', compact('sale'));
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
            $sale = Sale::find($id);
            if ($sale) {
                $companies =  Company::all();
                $categories =  Category::all();
                $brands = Brand::all();
                return view('sales.edit', compact('sale', 'categories', 'brands', 'companies'));
            }
            return redirect()->route('sales.index')
                ->with('error', 'Sale can\'t eddited.');
        } catch (Throwable $e) {
            report($e);
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaleRequest $request)
    {
        //
        try {
            $sale = Sale::find($request->sale_id);
            $sale->SKU = $request->input('SKU');
            $sale->name_ar = $request->input('name_ar');
            $sale->name_en = $request->input('name_en');
            $sale->name_fr = $request->input('name_fr');
            $sale->description = $request->input('description') ? $request->input('description') : '';
            $sale->code = $request->input('code') ? $request->input('code') : '';
            $sale->price = $request->input('price') ? $request->input('price') : '';
            $sale->discount = $request->input('discount') ? $request->input('discount') : '';
            $sale->category_id = $request->input('category_id') ? $request->input('category_id') : null;
            $sale->brand_id = $request->input('brand_id') ? $request->input('brand_id') : null;

            $destinationPath = 'companies/' . (Auth::User()->company->id) . '/' . 'sales/';
            $file = $request->file('image');
            //to do: delete old image
            if ($file){
                $fileName = $sale->id . '.' . $file->getClientOriginalExtension();
                Storage::disk('public')->put($destinationPath . $fileName, file_get_contents($file));
                $sale->image = $fileName;
                $sale->update(['image' => $fileName]);
            }

            $sale->save();
            return redirect()->route('sales.index')
                ->with('success', 'Sale updated successfully');
        } catch (Throwable $e) {
            report($e);
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
        try {
            $sale = Sale::find($id);
            if ($sale) {
                $sale->delete();
                return response()->json([
                    'message' => 'Sale deleted successfully'
                ], 200);
            }
            return response()->json([
                'message' => 'Sale not found'
            ], 404);
        } catch (Throwable $e) {
            report($e);
            Log::error($e->getMessage());

            return false;
        }
    }

    public function getSales()
    {
        //
        try {

            $data = [];
            $sales = (Auth::User()->role->name == 'user') ? Auth::User()->Enterprise->sales : Sale::all();

            return response()->json(['sales' => $sales]); //->select('id AS value', 'name AS text')]);//->pluck('id' as 'value', 'name' . ' '. 'brand' as 'text')], 404);
        } catch (Throwable $e) {
            report($e);
            Log::error($e->getMessage());

            return false;
        }
    }
}
