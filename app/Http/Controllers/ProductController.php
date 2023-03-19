<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Auth;
use File;
use Storage;
use App\Models\Product;
use App\Models\Company;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Store;

class ProductController extends Controller
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
            // $products = (Auth::User()->role->name == 'user') ? Auth::User()->Enterprise->products : Product::all();
            $products = Product::all();
            return view('products.index', compact('products'));
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
            return view('products.create', compact('companies', 'stores', 'categories', 'brands'));
        } catch (Throwable $e) {
            // report($e);
            // Log::error($e->getMessage());
            return false;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
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
            $product = new Product([
                'SKU' => $request->input('sku'),
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
                'store_id' => $request->input('store_id') ? $request->input('store_id') : ( Auth::User()->company ?
                                Auth::User()->company->store->id : null)
            ]);
            $product->save();

            // if (!file_exists('data/' . $destinationPath)) {
            //     File::makeDirectory('data/' . $destinationPath, $mode = 0777, true, true);
            // }

            $destinationPath = 'companies/' . (Auth::User()->company->id) . '/' . 'products/';
            $file = $request->file('image');
            $fileName = $product->id . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->put($destinationPath . $fileName, file_get_contents($file));
            $product->image = $fileName;
            $product->update(['image' => $fileName]);

            return redirect()->route('products.index')
                ->with('success', 'Product created successfully.');
        } catch (Throwable $e) {
            report($e);
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
        try {
            $product = Product::find($id);
            return view('products.show', compact('product'));
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
            $product = Product::find($id);
            if ($product) {
                $companies =  Company::all();
                $stores =  Store::all();
                $categories =  Category::all();
                $brands = Brand::all();
                return view('products.edit', compact('product', 'categories', 'brands', 'companies', 'stores'));
            }
            return redirect()->route('products.index')
                ->with('error', 'Product can\'t eddited.');
        } catch (Throwable $e) {
            report($e);
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
        try {
            $product = Product::find($id);
            $product->name = $request->input('name');
            $product->description = $request->input('description');
            $product->brand = $request->input('brand');
            $product->hs_code = $request->input('hs_code');
            $product->measure_unit = $request->input('measure_unit');
            $product->sub_category_id = $request->input('sub_category_id');
            if (Auth::User()->role->name != 'user'){
                $product->enterprise_id = $request->input('enterprise_id');
            }
            $product->save();
            return redirect()->route('products.index')
                ->with('success', 'Product updated successfully');
        } catch (Throwable $e) {
            report($e);
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
        try {
            $product = Product::find($id);
            if ($product) {
                $product->delete();
                return response()->json([
                    'message' => 'Product deleted successfully'
                ], 200);
            }
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        } catch (Throwable $e) {
            report($e);
            Log::error($e->getMessage());

            return false;
        }
    }

    public function getProducts()
    {
        //
        try {

            $data = [];
            $products = (Auth::User()->role->name == 'user') ? Auth::User()->Enterprise->products : Product::all();

            return response()->json(['products' => $products]); //->select('id AS value', 'name AS text')]);//->pluck('id' as 'value', 'name' . ' '. 'brand' as 'text')], 404);
        } catch (Throwable $e) {
            report($e);
            Log::error($e->getMessage());

            return false;
        }
    }
}
