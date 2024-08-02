<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Information;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantAttributeValue;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Get info user
        $id_user_logined = null;
        $user = null;
        if (Auth::check()) {
            $id_user_logined = Auth::user()->id;
            $user = User::rightJoin('informations as info', 'users.id', '=', 'info.user_id')
                ->where('info.user_id', '=', $id_user_logined)
                ->first();
        }
        //Get all categories
        $categories = Category::all();
        //Get all products
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
        return view('app.user.home', compact('categories', 'products', 'user'));
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
    public function show(string $id)
    {
        //Get all variant products
        $product = Product::with('productVariants.productAttributeValueDetail.attributeValue')->find($id);
        $array_variants = [];
        if ($product) {
            foreach ($product->productVariants as $productVariant) {
                $attributeValues = [];
                foreach ($productVariant->productAttributeValueDetail as $attributeValue) {
                    $attributeValues[] = $attributeValue->attribute_value_id;
                }
                $variantAttributes  = [
                    'variant_id' => $productVariant->id,
                    'stock' => $productVariant->stock,
                    'attribute_values' => $attributeValues
                ];
                $array_variants[] = $variantAttributes;
            }
        }
        // dd($array_variants);
        //Handle get all attributes
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
                'type' => $dataAttribute->type,
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
        //Get sum stock product variants
        $total_prices = ProductVariant::selectRaw('SUM(product_variants.stock) as total_stock')->where('product_variants.product_id', $id)->get();
        $total_stock = $total_prices[0]->total_stock;
        return view('app.user.productDetail', compact('productDetail', 'array_attributes', 'productImages', 'total_stock', 'array_variants'));
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
        if ($productFocusQuery->all()) {
            $productDetailUpdate = $productFocusQuery[0];
            $response = [
                'status' => 'success',
                'data' => $productDetailUpdate
            ];
            return response()->json($response);
        }
    }

    public function cart()
    {
        $carts = Auth::user()->carts;
        $cart_list = [];
        foreach ($carts as $itemCart) {
            $array_item_cart = [];
            $array_item_cart['quantity'] = $itemCart->quantity;
            $variants = $itemCart->productVariant;
            $array_item_cart['product_name'] = ProductVariant::select('p.name')->rightJoin('products as p', 'product_variants.product_id', '=', 'p.id')->first()->name;
            $array_item_cart['image'] = ProductVariant::select('p.image')->rightJoin('products as p', 'product_variants.product_id', '=', 'p.id')->first()->image;
            $array_item_cart['purchase_price'] = $variants->purchase_price;
            $array_item_cart['sale_price'] = $variants->sale_price;
            $array_item_cart['stock'] = $variants->stock;
            $array_item_cart['product_id'] = $variants->product_id;
            $array_item_cart['variant_id'] = $variants->id;
            $array_item_cart['id_cart'] = $itemCart->id;
            $array_item_attribute_values = [];
            $productAttributeValueDetail = ProductVariantAttributeValue::select('product_variant_attribute_values.*')->where('product_variant_attribute_values.product_variant_id', $variants->id)->get();
            foreach ($productAttributeValueDetail as $itemProductAttributeValueDetail) {
                $attributeValue = AttributeValue::select('attribute_values.value')->leftJoin('product_variant_attribute_values as pvv', 'attribute_values.id', '=', 'pvv.attribute_value_id')->where('pvv.id', $itemProductAttributeValueDetail->id)->get();
                foreach ($attributeValue as $itemAttributeValue) {
                    $array_item_attribute_values[] = $itemAttributeValue->value;
                }
            }
            $array_item_cart['attribute_values'] = $array_item_attribute_values;
            $cart_list[] = $array_item_cart;
        }
        $total_payment = 0;
        foreach ($cart_list as $item_cart) {
            if ($item_cart['sale_price'] != null) {
                $total_payment += $item_cart['sale_price'] * $item_cart['quantity'];
            } else {
                $total_payment += $item_cart['purchase_price'] * $item_cart['quantity'];
            }
        }
        return view('app.user.cart', compact('cart_list', 'total_payment'));
    }
    public function addToCart(string $variant_id, string $quantity)
    {
        $checkCart = Cart::with('productVariant')->where('product_variant_id', $variant_id)->where('user_id', Auth::user()->id)->first();
        if ($checkCart) {
            if ($checkCart->productVariant->stock < $checkCart->quantity + $quantity) {
                $checkCart->quantity = $checkCart->productVariant->stock;
            } else if ($checkCart->quantity + $quantity > 10) {
                $checkCart->quantity = 10;
            } else {
                $checkCart->quantity = $checkCart->quantity + $quantity;
            }
            $checkCart->updated_at->now();
            $checkCart->save();
        } else {
            Cart::create([
                'quantity' => $quantity,
                'product_variant_id' => $variant_id,
                'user_id' => Auth::user()->id,
                'created_at' => now()
            ]);
        }
        return redirect()->route('cart');
    }
    public function updateCart(Request $request)
    {
        try {
            $variant_id = $request->input('variant_id');
            $quantity = $request->input('quantity');
            $cartInfor = Cart::select('carts.*', 'pv.stock')
                ->leftJoin('product_variants as pv', 'carts.product_variant_id', '=', 'pv.id')
                ->where('user_id', Auth::user()->id)
                ->where('product_variant_id', $variant_id)
                ->first();
            if ($cartInfor) {
                if ($cartInfor->stock <= $quantity) {
                    $cartInfor->update([
                        'quantity' => $cartInfor->stock,
                        'updated_at' => now()
                    ]);
                } else {
                    $cartInfor->update([
                        'quantity' => $quantity,
                        'updated_at' => now()
                    ]);
                }
                $variants = ProductVariant::select('product_variants.id', 'product_variants.purchase_price', 'product_variants.sale_price', 'carts.quantity')
                    ->leftJoin('carts', 'product_variants.id', '=', 'carts.product_variant_id')
                    ->where('carts.user_id', Auth::user()->id)
                    ->get();
                $total_payment = 0;
                $total_price = 0;
                foreach ($variants as $itemVariant) {
                    if ($itemVariant->id == $variant_id) {
                        if ($itemVariant->sale_price != null) {
                            $total_price = $cartInfor->quantity * $itemVariant->sale_price;
                        } else {
                            $total_price = $cartInfor->quantity * $itemVariant->purchase_price;
                        }
                    }
                    if ($itemVariant->sale_price != null) {
                        $total_payment +=  $itemVariant->quantity * $itemVariant->sale_price;
                    } else {
                        $total_payment +=  $itemVariant->quantity * $itemVariant->purchase_price;
                    }
                }
                $response = [
                    'status' => 'success',
                    'new_quantity' => $cartInfor->quantity,
                    'total_price' => $total_price,
                    'total_payment' =>  $total_payment
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Cart item not found',
                ];
            }
            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function destroyCart(Request $request)
    {
        $cart_id = $request->input('cart_id');
        if ($cart_id) {
            $checkCart = Cart::find($cart_id);
            if ($checkCart) {
                $checkCart->delete();
                $response = [
                    'status' => 'success'
                ];
            } else {
                $response = [
                    'status' => 'success',
                    'message' => 'Không tìm thấy vật phẩm cần xóa!'
                ];
            }
        }
        $cart_array = $request->input('cart_array');
        if ($cart_array) {
            foreach ($cart_array as $cart_item) {
                $checkCart = Cart::find($cart_item);
                if ($checkCart) {
                    $checkCart->delete();
                    $response = [
                        'status' => 'success'
                    ];
                } else {
                    $response = [
                        'status' => 'success',
                        'message' => 'Không tìm thấy vật phẩm cần xóa!'
                    ];
                }
            }
        }
        return response()->json($response);
    }
    public function payment(String $items)
    {
        if ($items) {
            $items = explode(',', $items);
            $array_payments = [];
            $user_info = Information::where('user_id', Auth::user()->id)->where('is_active', 1)->first();
            $total_payment = 0;
            foreach ($items as $item) {
                $array_item = [];
                $itemInfo = Cart::with('productVariant')->where('carts.id', $item)->first();
                if ($itemInfo) {
                    $productName = ProductVariant::select('p.name', 'p.image')
                        ->leftJoin('products as p', 'product_variants.product_id', '=', 'p.id')
                        ->where('product_variants.id', $itemInfo->product_variant_id)
                        ->first();
                    $array_item['name'] = $productName->name;
                    $array_item['image'] = $productName->image;
                    $array_item_attribute_values = [];
                    $productAttributeValueDetail = ProductVariantAttributeValue::select('product_variant_attribute_values.*')->where('product_variant_attribute_values.product_variant_id', $itemInfo->product_variant_id)->get();
                    foreach ($productAttributeValueDetail as $itemProductAttributeValueDetail) {
                        $attributeValue = AttributeValue::select('attribute_values.value')->leftJoin('product_variant_attribute_values as pvv', 'attribute_values.id', '=', 'pvv.attribute_value_id')->where('pvv.id', $itemProductAttributeValueDetail->id)->get();
                        foreach ($attributeValue as $itemAttributeValue) {
                            $array_item_attribute_values[] = $itemAttributeValue->value;
                        }
                    }
                    $array_item['attribute_values'] = $array_item_attribute_values;
                    $array_item['purchase_price'] = $itemInfo->productVariant->purchase_price;
                    $array_item['sale_price'] = $itemInfo->productVariant->sale_price;
                    $array_item['quantity'] = $itemInfo->quantity;
                    if ($array_item['sale_price'] != null) {
                        $array_item['total_price'] = $itemInfo->quantity * $itemInfo->productVariant->sale_price;
                        $total_payment += $itemInfo->quantity * $itemInfo->productVariant->sale_price;
                    } else {
                        $array_item['total_price'] = $itemInfo->quantity * $itemInfo->productVariant->purchase_price;
                        $total_payment += $itemInfo->quantity * $itemInfo->productVariant->sale_price;
                    }
                    $array_payments[] = $array_item;
                    $transport_fee = 30000;
                    $total_payment_end = $total_payment - $transport_fee;
                } else {
                    return redirect()->route('cart');
                }

                // dd($array_payments);
            }
        } else {
            return redirect()->route('cart');
        }
        return view('app.user.payment', compact('array_payments', 'total_payment', 'user_info', 'total_payment_end', 'transport_fee'));
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
            'user_id' => 1,
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
            Cart::where('user_id', 1)->delete();
        }
        $orderDetail = Order::with('orderDetails.product')
            ->where('user_id', 1)
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
