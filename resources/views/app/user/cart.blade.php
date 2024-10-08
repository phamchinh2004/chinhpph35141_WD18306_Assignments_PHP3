@extends('app.layouts.userLayout')
@section('title','Giỏ hàng')
@section('content')
<div class="bg-light pt-3 pb-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-dark text-decoration-none fw-bold" href="{{route('userHome.index')}}">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
            </ol>
        </nav>
        <div class="bg-white">
            <div class="d-flex flex-column">
                <div class="d-flex justify-content-center align-items-center pt-5 pb-5 fs-3">
                    <i class="fa-solid fa-cart-plus fa-2xl"></i>
                </div>
                <div class="rounded">
                    <form action="">
                        @csrf
                        <table class="table table-hover">
                            <thead class="table-dark sticky-md-top margin-header" style="top:98px">
                                <tr>
                                    <th style="width: 30%">
                                        <div class="form-check">
                                            <input class="form-check-input checkBoxAll" type="checkbox" value="" id="checkBoxAll">
                                            <label class="form-check-label" for="checkBoxAll">
                                                Sản phẩm
                                            </label>
                                        </div>
                                    </th>
                                    <th></th>
                                    <th class="text-center">Đơn giá</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-center">Số tiền</th>
                                    <th class="text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart_list as $item_cart)
                                <tr class="item_cart" data-id="{{$item_cart['id_cart']}}">
                                    <td class="">
                                        <div class="form-check d-flex flex-row align-items-center">
                                            <input class="form-check-input me-3 product-checkbox checkBoxProduct" type="checkbox">
                                            <img class="me-3" src="{{asset('uploads/'.$item_cart['image'])}}" alt="" width="110">
                                            <h6 class="form-check-label">
                                                {{$item_cart['product_name']}}
                                            </h6>
                                        </div>
                                    </td>
                                    <td class="centered">
                                        <div class="d-flex text-center flex-column h-auto">
                                            <span>Phân loại hàng:</span>
                                            <span class="fw-bold">
                                                @foreach ($item_cart['attribute_values'] as $attribute_value)
                                                {{$attribute_value}}
                                                @endforeach
                                            </span>
                                        </div>
                                    </td>
                                    <td class="centered text-center">
                                        <div class="d-flex flex-row justify-content-center">
                                            <p class="mb-0 currency">
                                                @if ($item_cart['sale_price']==null)
                                                {{$item_cart['purchase_price']}}
                                                @else
                                                {{$item_cart['sale_price']}}
                                                @endif
                                            </p>
                                        </div>
                                    </td>
                                    <td class="centered">
                                        <div class="d-flex justify-content-center flex-column">
                                            <div class="d-flex flex-row justify-content-center align-items-center variantInfor mt-3" data-stock="{{$item_cart['stock']}}" data-id="{{$item_cart['variant_id']}}">
                                                <span class="btn btn-outline-dark btn-white d-flex justify-content-center align-items-center reduceCart" style="width:35px;">-</span>
                                                <input type="text" class="form-control text-align-center quantityCart" style="width:55px;" value="{{$item_cart['quantity']}}">
                                                <span class="btn btn-outline-dark btn-white d-flex align-items-center incrementCart" style="width:35px;">+</span>
                                            </div>
                                            <div class="d-flex flex-row justify-content-center align-items-center">
                                                <span class="badge text-dark">Tồn kho: {{$item_cart['stock']}}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="centered text-center">
                                        <div class="d-flex flex-row justify-content-center">
                                            <p class="mb-0 currency total_price">
                                                @if ($item_cart['sale_price']==null)
                                                {{$item_cart['purchase_price']*$item_cart['quantity']}}
                                                @else
                                                {{$item_cart['sale_price']*$item_cart['quantity']}}
                                                @endif
                                            </p>
                                        </div>
                                    </td>
                                    <td class="centered">
                                        <div class="d-flex justify-content-center">
                                            <button class="btn btn-danger deleteItemCart" data-id="{{$item_cart['id_cart']}}">Xóa</button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-dark sticky-md-bottom">
                                <tr>
                                    <th colspan="3">
                                        <div class="form-check d-flex align-items-center">
                                            <input class="form-check-input checkBoxAll" type="checkbox" value="" id="checkBoxAll">
                                            <label class="form-check-label ms-2" for="checkBoxAll">
                                                Chọn tất cả ({{count($cart_list)}})
                                            </label>
                                            <span class="btn btn-dark btn-outline-light ms-2" id="deleteAllSelectRecord">Xóa</span>
                                        </div>
                                    </th>
                                    <th>Tổng thanh toán ({{count($cart_list)}} sản phẩm)</th>
                                    <th>
                                        <div class="d-flex align-items-center ms-3">
                                            <!-- <p class="border-bottom border-white mb-1 fw-bold text-white me-1">đ</p> -->
                                            <h3 class="mb-0 text-white currency total_payment">{{$total_payment}}</h3>
                                        </div>
                                    </th>
                                    <th>
                                        <span class="btn btn-dark border-white btn-outline-light pt-3 pb-3 ps-5 pe-5 fw-bold" id="paymentCart">Mua hàng</>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection