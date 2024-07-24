<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantAttributeValue;
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
        //Handle find attributes
        $array_attribute_value_id = [];
        $array_attribute_id = [];
        $array_attributes = [];
        $attribute_value_ids = ProductVariant::leftJoin('products as p', 'product_variants.product_id', '=', 'p.id')
            ->leftJoin('product_variant_attribute_values as pvv', 'product_variants.id', '=', 'pvv.product_variant_id')
            ->select('pvv.attribute_value_id as attribute_value_id')
            ->where('p.id', $id)
            ->groupBy('attribute_value_id')
            ->get();
        foreach ($attribute_value_ids as $attribute_value_id) {
            if ($attribute_value_id->attribute_value_id != null) {
                $array_attribute_value_id[] = $attribute_value_id->attribute_value_id;
            }
        }
        foreach ($array_attribute_value_id as $attribute_value_id) {
            $attributes = AttributeValue::select('attribute_id')
                ->where('attribute_values.id', $attribute_value_id)
                ->first();
            // dd($attributes);
            if ($attributes) {
                if (!in_array($attributes->attribute_id, $array_attribute_id)) {
                    $array_attribute_id[] = $attributes->attribute_id;
                }
            }
        }
        sort($array_attribute_id);
        foreach ($array_attribute_id as $attribute_id) {
            $dataAttribute = Attribute::with('attributeValues')->where('id', $attribute_id)->first();
            $array_attributes[$attribute_id] = [
                'id' => $dataAttribute->id,
                'name' => $dataAttribute->name,
                'attribute_values' => $dataAttribute->attributeValues->map(function ($value) {
                    return [
                        'id' => $value->id,
                        'value' => $value->value,
                        'image' => $value->image
                    ];
                })->toArray()
            ];
            foreach ($array_attributes[$attribute_id]['attribute_values'] as $key => $attribute_value) {
                if (!in_array($attribute_value['id'], $array_attribute_value_id)) {
                    unset($array_attributes[$attribute_id]['attribute_values'][$key]);
                }
            }
        }
        //Product query
        $productDetail = Product::where('id', $id)->first();
        //Get product images
        $productImages = ProductVariant::select('product_variants.image')
            ->where('product_variants.product_id', $id)
            ->groupBy('product_variants.image')
            ->get();
        return view('app.user.productDetail', compact('productDetail', 'array_attributes', 'productImages'));
    }
    public function updateInformationProduct(Request $request)
    {
        $array_attribute_value_ids = $request->input('attribute_value_ids');
        $product_id = $request->input('product_id');
        $productFocusQuery = ProductVariantAttributeValue::leftJoin('attribute_values as av', 'product_variant_attribute_values.attribute_value_id', '=', 'av.id')
            ->leftJoin('product_variants as pv', 'product_variant_attribute_values.product_variant_id', '=', 'pv.id')
            ->leftJoin('products as p', 'pv.product_id', '=', 'p.id')
            ->select('pv.*')
            ->selectRaw('COUNT(product_variant_attribute_values.attribute_value_id) as total_attribute_value_id')
            ->where('pv.product_id', $product_id)
            ->whereIn('product_variant_attribute_values.attribute_value_id', $array_attribute_value_ids)
            ->groupBy('pv.id')
            ->having(DB::raw('COUNT(product_variant_attribute_values.attribute_value_id)'), '=', count($array_attribute_value_ids))
            ->get();
        if($productFocusQuery->all()){
            $productDetailUpdate = $productFocusQuery[0];
            return response()->json(['status' => 'success', 'data' => $productDetailUpdate]);
        }
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
            'shipping_voucher' => 0,
            'voucher' => 0,
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
        $orderDetail = Order::with('orderDetails.product')
            ->where('account_id', 1)
            ->where('id', $order->id)
            // ->where('id', 1)
            ->first();
        // dd($orderDetail);
        return view('app.user.order', compact('orderDetail'));
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
