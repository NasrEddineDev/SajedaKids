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
use App\Models\Product;
use App\Models\PurchaseItem;
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
            return view('purchases.create');
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

            $purchase = new Purchase([
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
            $purchase->save();

            $net_amount = 0;
            $purchasedProducts = collect((array)json_decode($request->input('products')));
            foreach ($purchasedProducts as $purchasedProduct) {

                $product = Product::where('SKU', $purchasedProduct->SKU)->first();
                $total = $purchasedProduct->price * $purchasedProduct->quantity;
                $purchaseItem = new PurchaseItem([
                    'total_amount' => $total,
                    'quantity' => $purchasedProduct->quantity,
                    'price' => $purchasedProduct->price,
                    'date' => $request->input('date') ? $request->input('date') : '',
                    'description' => '',
                    'product_price' => $product->price,
                    'product_discount' => $product->discount,
                    'product_sku' => $product->SKU,
                    'product_name' => $product->name,
                    'user_id' => Auth::User()->id,
                    'purchase_id' => $purchase->id,
                    'product_id' => $product->id,
                ]);
                $purchaseItem->save();
                $net_amount += $total;
                $product->quantity = $product->quantity + $purchasedProduct->quantity;
                $product->update();
            }
            $purchase->net_amount = $net_amount;
            $purchase->total_amount = $net_amount;
            $purchase->save();

            return response()->json([
                'message' => 'Purchase saved successfully',
                'result' => 'success',
                'url' => route('purchases.index'),
                'url_close' => route('purchases.index')
            ], 200);

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
            $purchase = Purchase::where('id','=',$id)->withCount('PurchaseItems')->first();
            if ($purchase) {
                return view('purchases.edit', compact('purchase'));
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
            if($purchase){
                if ($request->input('date')) $purchase->date =  $request->input('date');
                $purchase->user_id = Auth::User()->id;
                $purchase->save();

                foreach ($purchase->purchaseItems as $purchaseItem) {
                    $product = Product::where('SKU', $purchaseItem->product_sku)->first();
                    $product->quantity = $product->quantity - $purchaseItem->quantity;
                    $product->update();
                }
                $purchase->purchaseItems()->delete();

                $net_amount = 0;
                $purchasedProducts = collect((array)json_decode($request->input('products')));
                foreach ($purchasedProducts as $purchasedProduct) {
                    $product = Product::where('SKU', $purchasedProduct->SKU)->first();
                    $total = $purchasedProduct->price * $purchasedProduct->quantity;
                    $purchaseItem = new PurchaseItem([
                        'total_amount' => $total,
                        'quantity' => $purchasedProduct->quantity,
                        'price' => $purchasedProduct->price,
                        'date' => $request->input('date') ? $request->input('date') : '',
                        'description' => '',
                        'product_price' => $product->price,
                        'product_discount' => $product->discount,
                        'product_sku' => $product->SKU,
                        'product_name' => $product->name,
                        'user_id' => Auth::User()->id,
                        'purchase_id' => $purchase->id,
                        'product_id' => $product->id,
                    ]);
                    $purchaseItem->save();
                    $net_amount += $total;
                    $product->quantity = $product->quantity + $purchaseItem->quantity;
                    $product->update();
                }
                $purchase->net_amount = $net_amount;
                $purchase->total_amount = $net_amount;
                $purchase->save();
                return response()->json([
                    'message' => 'Purchase saved successfully',
                    'result' => 'success',
                    'url' => route('purchases.index')
                ], 200);
            }

            return response()->json([
                'message' => 'Purchase not saved',
                'result' => 'error',
                'post' => $request->all(),
                'url' => route('purchases.index')
            ], 200);


            // $purchase->SKU = $request->input('SKU');
            // $purchase->name_ar = $request->input('name_ar');
            // $purchase->name_en = $request->input('name_en');
            // $purchase->name_fr = $request->input('name_fr');
            // $purchase->description = $request->input('description') ? $request->input('description') : '';
            // $purchase->code = $request->input('code') ? $request->input('code') : '';
            // $purchase->price = $request->input('price') ? $request->input('price') : '';
            // $purchase->discount = $request->input('discount') ? $request->input('discount') : '';
            // $purchase->category_id = $request->input('category_id') ? $request->input('category_id') : null;
            // $purchase->brand_id = $request->input('brand_id') ? $request->input('brand_id') : null;

            // $destinationPath = 'companies/' . (Auth::User()->company->id) . '/' . 'purchases/';
            // $file = $request->file('image');
            // //to do: delete old image
            // if ($file){
            //     $fileName = $purchase->id . '.' . $file->getClientOriginalExtension();
            //     Storage::disk('public')->put($destinationPath . $fileName, file_get_contents($file));
            //     $purchase->image = $fileName;
            //     $purchase->update(['image' => $fileName]);
            // }

            // $purchase->save();
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
    public function destroy($id)
    {
        //
        try {
            $purchase = Purchase::find($id);
            if ($purchase) {
                $purchase->delete();
                return response()->json([
                    'done' => true,
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

    public function getPurchaseDetails($id)
    {

        try {
            $purchase = Purchase::find($id);
            if ($purchase) {
                return response()->json([
                    'message' => 'success',
                    'purchase' => $purchase,
                    'purchase_items' => $purchase->purchaseItems
                ], 200);
            }
            return response()->json([
                'message' => 'Purchase not found'
            ], 404);
        } catch (Throwable $e) {
            // report($e);
            // Log::error($e->getMessage());

            return false;
        }
    }
}
