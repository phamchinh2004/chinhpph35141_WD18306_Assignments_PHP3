<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
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
        // $productDetail = Product::with('variants.attributeValues.attributeValue.attribute', 'variants.attributeValues.attributeValue')
        //     ->find($id);
        $productDetail = Product::all()->where('id', $id)->first();
        return view('app.user.productDetail', compact('productDetail'));
    }

    public function cart()
    {
        $productCart = Cart::with('product')->get();
        $total_payment = 0;
        foreach ($productCart as $product) {
            $total_payment += $product->product->sale_price;
        }
        return view('app.user.cart', compact('productCart', 'total_payment'));
    }
    public function addToCart(string $id)
    {
        Cart::create([
            'quantity' => 1,
            'product_id' => $id,
            'product_variant_id' => 1,
            'account_id' => 1,
            'created_at' => now()
        ]);
        return redirect()->route('cart');
    }
    public function payment()
    {
        $productsPayment = Cart::with('product')->get();
        $total_payment = 0;
        $shipping = 30000;
        foreach ($productsPayment as $product) {
            $total_payment += $product->product->sale_price;
        }
        return view('app.user.payment', compact('productsPayment', 'total_payment', 'shipping'));
    }
    public function order()
    {
        $productsPayment = Cart::with('product')->get();
        $total_cost = 0;
        $shipping = 30000;
        foreach ($productsPayment as $product) {
            $total_cost += $product->product->sale_price;
        }
        $total_payment = $total_cost + $shipping;
        $order = Order::create([
            'total_cost' => $total_cost,
            'shipping_price' => $shipping,
            'shipping_voucher' => '',
            'voucher' => '',
            'total_payment' => $total_payment,
            'account_id' => 1,
            'created_at' => now()
        ]);
        foreach ($productsPayment as $product) {
            OrderDetail::create([
                'value_variants' => 'Faker,M',
                'price' => $product->product->sale_price,
                'quantity' => $product->quantity,
                'total_price' => $product->product->sale_price * $product->quantity,
                'order_id' => $order->id,
                'product_id' => $product->product->id,
                'created_at' => now()
            ]);
        }
        foreach ($productsPayment as $product) {
            Cart::where('account_id', 1)->delete();
        }
        
        return view('app.user.order');
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
