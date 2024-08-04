<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\SendEmailOrderSuccess;
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
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
        $products = Product::leftJoin('product_variants as pv', 'products.id', '=', 'pv.product_id')
            ->leftJoin('order_details as od', 'pv.id', '=', 'od.product_variant_id')
            ->leftJoin('orders as o', 'od.order_id', '=', 'o.id') // Join với bảng orders
            ->select('products.*', DB::raw('COALESCE(SUM(CASE WHEN o.status = 2 THEN od.quantity ELSE 0 END), 0) AS total_quantity_sold'))
            ->groupBy('products.id', 'products.name', 'products.description', 'products.sale_price', 'products.purchase_price')
            ->orderBy('total_quantity_sold', 'desc')
            ->get();
        return view('app.user.home', compact('categories', 'products', 'user'));
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //Get all variant products
        $product = Product::with('productVariants.productAttributeValueDetail.attributeValue')->find($id);
        $product->view = $product->view + 1;
        $product->save();
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
            $variant = ProductVariant::select('stock')->where('id', $variant_id)->first();
            if ($variant) {
                Cart::create([
                    'quantity' => $quantity <= $variant->stock ? $quantity : $variant->stock,
                    'product_variant_id' => $variant_id,
                    'user_id' => Auth::user()->id,
                    'created_at' => now()
                ]);
            }
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
                    $variantAttributeValueDetail = ProductVariantAttributeValue::select('product_variant_attribute_values.*')->where('product_variant_attribute_values.product_variant_id', $itemInfo->product_variant_id)->get();
                    foreach ($variantAttributeValueDetail as $itemVariantAttributeValueDetail) {
                        $attributeValue = AttributeValue::select('attribute_values.value')->leftJoin('product_variant_attribute_values as pvv', 'attribute_values.id', '=', 'pvv.attribute_value_id')->where('pvv.id', $itemVariantAttributeValueDetail->id)->get();
                        foreach ($attributeValue as $itemAttributeValue) {
                            $array_item_attribute_values[] = $itemAttributeValue->value;
                        }
                    }
                    $array_item['variant_id'] = $itemInfo->product_variant_id;
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
                    $total_payment_end = $total_payment + $transport_fee;
                    $listVoucher = Voucher::select('vouchers.*', DB::raw('DATEDIFF(end_date, NOW()) as days_remaining'))
                        ->where('type', '!=', 'free_ship')->where('quantity', '>', 0)->where('is_active', 1)->where('end_date', '>', now())->get();
                    $listFreeshipVoucher = Voucher::select('vouchers.*', DB::raw('DATEDIFF(end_date, NOW()) as days_remaining'))
                        ->where('type', 'free_ship')->where('quantity', '>', 0)->where('is_active', 1)->where('end_date', '>', now())->get();
                    $_SESSION['payment'] = $array_payments;
                    session(['payment' => $array_payments]);
                } else {
                    return redirect()->route('cart');
                }

                // dd($array_payments);
            }
        } else {
            return redirect()->route('cart');
        }
        // dd(session('payment'));
        return view('app.user.payment', compact('array_payments', 'total_payment', 'user_info', 'total_payment_end', 'transport_fee', 'listVoucher', 'listFreeshipVoucher'));
    }
    public function order(Request $request)
    {
        if ($request->all()) {
            if (session()->has('payment')) {
                $total_payment_base = $request->input('total_payment_base');
                $total_payment = $request->input('total_payment');
                $shipping_voucher = $request->input('shipping_voucher');
                $voucher = $request->input('voucher');
                $freeship_id = $request->input('freeship_id');
                $voucher_id = $request->input('voucher_id');
                $insertOrder = Order::create([
                    'total_cost' => $total_payment_base,
                    'shipping_price' => 30000,
                    'shipping_voucher' => $shipping_voucher,
                    'voucher' => $voucher,
                    'total_payment' => $total_payment,
                    'user_id' => Auth::user()->id
                ]);
                $newOrderId = null;
                if ($insertOrder) {
                    $newOrderId = $insertOrder->id;
                    foreach (session('payment') as $item) {
                        $attributeValues = implode(' ', $item['attribute_values']);
                        $insertOrderDetail = OrderDetail::create([
                            'value_variants' => $attributeValues,
                            'price' => $item['sale_price'] ? $item['sale_price'] : $item['purchase_price'],
                            'quantity' => $item['quantity'],
                            'total_price' => $item['total_price'],
                            'order_id' => $insertOrder->id,
                            'product_variant_id' => $item['variant_id']
                        ]);
                        if (!$insertOrderDetail) {
                            $response = [
                                'status' => 'error',
                                'message' => 'Đã xảy ra lỗi khi thêm dữ liệu vào bảng orderDetail!',
                            ];
                            return response()->json($response);
                        }
                        Cart::where('product_variant_id', $item['variant_id'])->delete();
                    }
                    if ($freeship_id != 0 && $voucher_id != 0) {
                        $quantityFreeshipVoucher = Voucher::select('quantity')->where('id', $freeship_id)->first();
                        $quantityFreeshipVoucher->quantity = $quantityFreeshipVoucher->quantity - 1;
                        $quantityFreeshipVoucher->save();
                        $quantityVoucher = Voucher::select('quantity')->where('id', $voucher_id)->first();
                        $quantityVoucher->quantity = $quantityVoucher->quantity - 1;
                        $quantityVoucher->save();
                    } else if ($freeship_id != 0) {
                        $quantityFreeshipVoucher = Voucher::select('quantity')->where('id', $freeship_id)->first();
                        $quantityFreeshipVoucher->quantity = $quantityFreeshipVoucher->quantity - 1;
                        $quantityFreeshipVoucher->save();
                    } else if ($voucher_id != 0) {
                        $quantityVoucher = Voucher::select('quantity')->where('id', $voucher_id)->first();
                        $quantityVoucher->quantity = $quantityVoucher->quantity - 1;
                        $quantityVoucher->save();
                    }
                    $orderDetailData = [];
                    $orderDetailData['total_cost'] = $insertOrder->total_cost;
                    $orderDetailData['shipping_price'] = $insertOrder->shipping_price;
                    $orderDetailData['shipping_voucher'] = $insertOrder->shipping_voucher;
                    $orderDetailData['voucher'] = $insertOrder->voucher;
                    $orderDetailData['total_payment'] = $insertOrder->total_payment;
                    $orderDetailData['status'] = $insertOrder->status;
                    $orderDetailData['created_at'] = $insertOrder->created_at;
                    $orderDetail = OrderDetail::where('order_id', $insertOrder->id)->get();
                    $informationUser = Information::leftJoin('users as u', 'informations.user_id', '=', 'u.id')
                        ->leftJoin('orders as o', 'u.id', '=', 'o.user_id')
                        ->where('u.id', Auth::user()->id)
                        ->where('o.id', $insertOrder->id)
                        ->where('informations.is_active', '=', 1)
                        ->first();
                    if ($informationUser) {
                        $orderDetailData['full_name'] = $informationUser->full_name;
                        $orderDetailData['address'] = $informationUser->address;
                        $orderDetailData['phone_number'] = $informationUser->phone_number;
                    }
                    if ($orderDetail) {
                        $array_product_detail = [];
                        foreach ($orderDetail as $item) {
                            $productVariant = Product::leftJoin('product_variants as pv', 'products.id', '=', 'pv.product_id')
                                ->where('pv.id', $item->product_variant_id)->first();
                            if ($productVariant) {
                                $array_product_detail['image'] = $productVariant->image;
                                $array_product_detail['name'] = $productVariant->name;
                            }
                            $array_product_detail['attribute_values'] = $item->value_variants;
                            $array_product_detail['price'] = $item->price;
                            $array_product_detail['quantity'] = $item->quantity;
                            $array_product_detail['total_price'] = $item->total_price;
                            $orderDetailData['product_variants'][] = $array_product_detail;
                        }
                    } else {
                        return redirect()->route('userHome.index');
                    }
                    $full_name = Auth::user()->informations->first()->full_name;
                    Mail::to(Auth::user()->email)->send(new SendEmailOrderSuccess($full_name, $orderDetailData));
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Đã xảy ra lỗi khi thêm dữ liệu vào bảng order!',
                    ];
                    return response()->json($response);
                }
                $response = [
                    'status' => 'success',
                    'message' => 'Lấy dữ liệu thành công!',
                    'data' => $newOrderId
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Không tìm thấy thông tin sản phẩm cần thêm!',
                ];
                return response()->json($response);
            }
        } else {
            return view('app.user.order');
        }
        return response()->json($response);
    }
    public function orderDetail(String $order_id)
    {
        $orderDetailData = [];
        $order = Order::where('id', $order_id)->where('user_id', Auth::user()->id)->first();
        if ($order) {
            $orderDetailData['total_cost'] = $order->total_cost;
            $orderDetailData['shipping_price'] = $order->shipping_price;
            $orderDetailData['shipping_voucher'] = $order->shipping_voucher;
            $orderDetailData['voucher'] = $order->voucher;
            $orderDetailData['total_payment'] = $order->total_payment;
            $orderDetailData['status'] = $order->status;
            $orderDetailData['created_at'] = $order->created_at;
            $orderDetail = OrderDetail::where('order_id', $order_id)->get();
            $informationUser = Information::leftJoin('users as u', 'informations.user_id', '=', 'u.id')
                ->leftJoin('orders as o', 'u.id', '=', 'o.user_id')
                ->where('u.id', Auth::user()->id)
                ->where('o.id', $order_id)
                ->where('informations.is_active', '=', 1)
                ->first();
            if ($informationUser) {
                $orderDetailData['full_name'] = $informationUser->full_name;
                $orderDetailData['address'] = $informationUser->address;
                $orderDetailData['phone_number'] = $informationUser->phone_number;
            }
            if ($orderDetail) {
                $array_product_detail = [];
                foreach ($orderDetail as $item) {
                    $productVariant = Product::leftJoin('product_variants as pv', 'products.id', '=', 'pv.product_id')
                        ->where('pv.id', $item->product_variant_id)->first();
                    if ($productVariant) {
                        $array_product_detail['image'] = $productVariant->image;
                        $array_product_detail['name'] = $productVariant->name;
                    }
                    $array_product_detail['attribute_values'] = $item->value_variants;
                    $array_product_detail['price'] = $item->price;
                    $array_product_detail['quantity'] = $item->quantity;
                    $array_product_detail['total_price'] = $item->total_price;
                    $orderDetailData['product_variants'][] = $array_product_detail;
                }
            } else {
                return redirect()->route('userHome.index');
            }
        } else {
            return redirect()->route('userHome.index');
        }
        // dd($orderDetailData);
        return view('app.user.order', compact('orderDetailData'));
    }
    /**
     * Show the form for editing the specified resource.
     */
}
