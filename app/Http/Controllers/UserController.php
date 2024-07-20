<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $products = Product::leftJoin('order_details', 'order_details.product_id', '=', 'products.id')
            ->select('products.*', DB::raw('SUM(order_details.quantity) as total_quantity'))
            ->groupBy('products.id')
            ->orderBy('total_quantity', 'desc')
            ->get();
        foreach ($products as $product) {
            if (!$product->total_quantity) {
                $product->total_quantity = 0;
            }
        }
        return view('app.user.home', compact('categories', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product, string $id)
    {
        $productDetail = Product::with('variants.attributeValues.attributeValue.attribute', 'variants.attributeValues.attributeValue')
            ->find($id);
        // dd($productDetail);
        return view('app.user.productDetail', compact('productDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
