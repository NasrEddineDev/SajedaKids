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
use App\Models\Product;
use App\Models\SaleItem;
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
            return view('sales.create');
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

            $sale = new Sale([
                'status' => "Completed",
                'date' => $request->input('date') ? $request->input('date') : '',
                'description' => '',
                'type' => 'Normal',
                'net_amount' => 0,
                'tax' => 0,
                'total_amount' => 0,
                'user_id' => Auth::User()->id,
                'customer_id' => null,
                'store_id' => Auth::User()->store->id,
            ]);
            $sale->save();

            $net_amount = 0;
            $saledProducts = collect((array)json_decode($request->input('products')));
            foreach ($saledProducts as $saledProduct) {

                $product = Product::where('SKU', $saledProduct->SKU)->first();
                $total = ($product->price - $saledProduct->discount)*$saledProduct->quantity;
                $saleItem = new SaleItem([
                    'total_amount' => $total,
                    'Quantity' => $saledProduct->quantity,
                    'discount' => $saledProduct->discount,
                    'date' => $request->input('date') ? $request->input('date') : '',
                    'description' => '',
                    'product_price' => $product->price,
                    'product_discount' => $product->discount,
                    'product_sku' => $product->SKU,
                    'product_name' => $product->name,
                    'user_id' => Auth::User()->id,
                    'sale_id' => $sale->id,
                    'product_id' => $product->id,
                ]);
                $saleItem->save();
                $net_amount += $total;
            }
            $sale->net_amount = $net_amount;
            $sale->total_amount = $net_amount;
            $sale->save();

            return response()->json([
                'message' => 'Sale saved successfully',
                'result' => 'success',
                'url' => route('sales.index')
            ], 200);

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
            $sale = Sale::where('id','=',$id)->withCount('SaleItems')->first();
            if ($sale) {
                return view('sales.edit', compact('sale'));
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
            if($sale){
                if ($request->input('date')) $sale->date =  $request->input('date');
                $sale->user_id = Auth::User()->id;
                $sale->save();

                $sale->saleItems()->delete();
                $net_amount = 0;
                $saledProducts = collect((array)json_decode($request->input('products')));
                foreach ($saledProducts as $saledProduct) {

                    $product = Product::where('SKU', $saledProduct->SKU)->first();
                    $total = ($product->price - $saledProduct->discount)*$saledProduct->quantity;
                    $saleItem = new SaleItem([
                        'total_amount' => $total,
                        'Quantity' => $saledProduct->quantity,
                        'discount' => $saledProduct->discount,
                        'date' => $request->input('date') ? $request->input('date') : '',
                        'description' => '',
                        'product_price' => $product->price,
                        'product_discount' => $product->discount,
                        'product_sku' => $product->SKU,
                        'product_name' => $product->name,
                        'user_id' => Auth::User()->id,
                        'sale_id' => $sale->id,
                        'product_id' => $product->id,
                    ]);
                    $saleItem->save();
                    $net_amount += $total;
                }
                $sale->net_amount = $net_amount;
                $sale->total_amount = $net_amount;
                $sale->save();
            }

            return response()->json([
                'message' => 'Sale saved successfully',
                'result' => 'success',
                'url' => route('sales.index')
            ], 200);


            // $sale->SKU = $request->input('SKU');
            // $sale->name_ar = $request->input('name_ar');
            // $sale->name_en = $request->input('name_en');
            // $sale->name_fr = $request->input('name_fr');
            // $sale->description = $request->input('description') ? $request->input('description') : '';
            // $sale->code = $request->input('code') ? $request->input('code') : '';
            // $sale->price = $request->input('price') ? $request->input('price') : '';
            // $sale->discount = $request->input('discount') ? $request->input('discount') : '';
            // $sale->category_id = $request->input('category_id') ? $request->input('category_id') : null;
            // $sale->brand_id = $request->input('brand_id') ? $request->input('brand_id') : null;

            // $destinationPath = 'companies/' . (Auth::User()->company->id) . '/' . 'sales/';
            // $file = $request->file('image');
            // //to do: delete old image
            // if ($file){
            //     $fileName = $sale->id . '.' . $file->getClientOriginalExtension();
            //     Storage::disk('public')->put($destinationPath . $fileName, file_get_contents($file));
            //     $sale->image = $fileName;
            //     $sale->update(['image' => $fileName]);
            // }

            // $sale->save();
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
    public function destroy($id)
    {
        //
        try {
            $sale = Sale::find($id);
            if ($sale) {
                $sale->delete();
                return response()->json([
                    'done' => true,
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

    public function getSaleDetails($id)
    {

        try {
            $sale = Sale::find($id);
            if ($sale) {
                return response()->json([
                    'message' => 'success',
                    'sale' => $sale,
                    'sale_items' => $sale->saleItems
                ], 200);
            }
            return response()->json([
                'message' => 'Sale not found'
            ], 404);
        } catch (Throwable $e) {
            // report($e);
            // Log::error($e->getMessage());

            return false;
        }
    }
}
