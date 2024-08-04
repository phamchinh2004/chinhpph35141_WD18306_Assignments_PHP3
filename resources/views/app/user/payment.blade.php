@extends('app.layouts.userLayout')
@section('title','Thanh toán')
@section('content')
<div class="bg-light pt-3 pb-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-dark text-decoration-none fw-bold" href="{{route('userHome.index')}}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a class="text-dark text-decoration-none fw-bold" href="{{route('cart')}}">Giỏ hàng</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thanh toán</li>
            </ol>
        </nav>
        <div class="bg-white p-3">
            <div class="d-flex flex-column">
                <h3 class="text-center pt-3 pb-3"><i class="fa-solid fa-credit-card me-2"></i>Thanh toán</h3>
                <div class="d-flex flex-column border-top">
                    <div class="d-flex flex-row align-items-center">
                        <i class="fa-solid fa-location-dot fa-md mt-4 me-2 text-danger"></i>
                        <p class="m-0 mt-4 fs-5 text-danger">Địa chỉ nhận hàng</p>
                    </div>
                    <div class="d-flex flex-row align-items-center mt-3">
                        <h5 class="m-0 me-2">{{$user_info->full_name}}</h5>
                        <h5 class="m-0 me-3">(+84) {{$user_info->phone_number}}</h5>
                        <p class="m-0 me-3">{{$user_info->address}}
                        </p>
                        <span class="badge bg-white text-danger border-danger border me-3">Mặc định</span>
                        <div class="btn btn-white btn-outline-dark">Thay đổi</div>
                    </div>
                </div>
                <div class="mt-4">
                    <table class="table table-hover">
                        <thead class="table-dark margin-header" style="top:98px">
                            <tr>
                                <th class="text-center w-25">Sản phẩm</th>
                                <th></th>
                                <th class="text-center">Đơn giá</th>
                                <th class="text-center">Số lượng</th>
                                <th class="text-center">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($array_payments as $item)

                            <tr class="">
                                <td class="">
                                    <div class="form-check d-flex flex-row align-items-center">
                                        <img class="me-3" src="{{$item['image']}}" alt="" width="110">
                                        <h6 class="form-check-label">
                                            {{$item['name']}}
                                        </h6>
                                    </div>
                                </td>
                                <td class="centered">
                                    <div class="d-flex text-center flex-column h-auto">
                                        <span>Phân loại hàng:</span>
                                        <span class="fw-bold">
                                            @foreach ($item['attribute_values'] as $attribute_value)
                                            {{$attribute_value}}
                                            @endforeach
                                        </span>
                                    </div>
                                </td>
                                <td class="centered text-center currency">
                                    @if ($item['sale_price']!=null)
                                    {{$item['sale_price']}}
                                    @else
                                    {{$item['purchase_price']}}
                                    @endif
                                </td>
                                <td class="centered text-center">{{$item['quantity']}}</td>

                                <td class="centered text-center text-danger currency">{{$item['total_price']}}</td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex flex-row justify-content-around">
                        <div class="d-flex flex-row align-items-center">
                            <i class="fa-solid fa-ticket fa-md me-2"></i>
                            <h5 class="m-0">VOUCHER</h5>
                        </div>
                        <div class="d-flex flex-row align-items-center">
                            <span class="badge value_voucher_base"></span>
                        </div>
                        <span class="btn btn-white btn-outline-dark voucher-click">Chọn voucher</span>
                    </div>
                    <div class="d-flex flex-row justify-content-around mt-4">
                        <div class="d-flex flex-row align-items-center">
                            <i class="fa-solid fa-ticket fa-md me-2"></i>
                            <h5 class="m-0">FREESHIP VOUCHER</h5>
                        </div>
                        <div class="d-flex flex-row align-items-center">
                            <span class="badge value_shipping_voucher_base"></span>
                        </div>
                        <span class="btn btn-white btn-outline-dark freeship-voucher-click">Chọn voucher</span>
                    </div>
                    <div class="d-flex flex-row justify-content-around align-items-center mt-4">
                        <div class="d-flex flex-row align-items-center">
                            <i class="fa-solid fa-credit-card fa-md me-2"></i>
                            <h5 class="m-0">Phương thức thanh toán</h5>
                        </div>
                        <div>
                            <p class="m-0">Thanh toán khi nhận hàng</p>
                        </div>
                        <button class="btn btn-white btn-outline-dark">Thay đổi</button>
                    </div>
                    <div class="d-flex flex-row justify-content-around align-items-center mt-4">
                        <div class="d-flex flex-row align-items-center">
                            <i class="fa-solid fa-truck fa-md me-2"></i>
                            <h5 class="m-0">Thời gian giao hàng: 3-5 ngày</h5>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-5 bg-light">
                        <table class="table table-light w-25">
                            <tbody>
                                <tr>
                                    <td>Tổng tiền hàng</td>
                                    <th class="currency">{{$total_payment}}</th>
                                </tr>
                                <tr>
                                    <td>Phí vận chuyển
                                    </td>
                                    <th class="currency">{{$transport_fee}}</th>
                                </tr>
                                <tr>
                                    <td>Giảm phí vận chuyển
                                    </td>
                                    <th class="reduce_shipping_costs currency">0</th>
                                </tr>
                                <tr>
                                    <td class="">Voucher từ e-SportsJacket
                                    </td>
                                    <th>
                                        <div class="d-flex flex-row">
                                            <p class="m-0 currency reduce_voucher_costs me-2">0</p>
                                            <p class="m-0 currency detail_reduce_voucher_costs text-success"></p>
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <td class="centered fw-bold">Tổng thanh toán
                                    </td>
                                    <th class="fs-4 text-danger fw-bold currency total_payment">{{$total_payment_end}}</th>
                                </tr>
                                <tr>
                                    <th colspan="2" class="text-center">
                                        <span class="btn btn-danger ps-5 pe-5 pt-2 pb-2 fw-bold payment_click">
                                            Đặt hàng
                                        </span>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="overlay"></div>
    <div class="form-voucher border border-dark rounded text-white form_voucher_css form_voucher bg-dark">
        <span class="w-100 d-flex justify-content-end pt-4 pe-3 text-decoration-none btn_close_form_css close_form_voucher">
            <i class="fa-solid fa-close fa-2xl text-white"></i>
        </span>
        <div class="p-4 ">
            @foreach ($listVoucher as $itemVoucher)
            <div class="d-flex flex-row align-items-center justify-content-between border border-white p-2 rounded mb-3 item_voucher bg-dark">
                <div class="w-25 me-2">
                    <img src="{{$itemVoucher->image}}" alt="" class="w-100">
                </div>
                <div class="w-50">
                    <div class="lh-lg">
                        <h5 class="m-0">{{$itemVoucher->name}}</h5>
                        <span class="badge border border-white">Code: {{$itemVoucher->code}}</span>
                        <div class="d-flex flex-row">Đơn tối thiểu: <p class="mb-0 ms-1 currency">{{$itemVoucher->minimum_order_value}}</p>
                        </div>
                        <div class="d-flex flex-column align-items-start lh-lg">
                            <span class="badge mb-1 p-0">HSD: {{$itemVoucher->end_date}}</span>
                            <span class="badge mb-0 p-0 text-danger">Hết hạn sau {{$itemVoucher->days_remaining}} ngày</span>
                            <span class="badge mb-0 p-0 text-success">Còn: {{$itemVoucher->quantity}}</span>
                        </div>
                    </div>
                </div>
                <div class="w-25">
                    <span class="btn btn-dark text-dark bg-white use_voucher" data-id="{{$itemVoucher->id}}" data-type="{{$itemVoucher->type}}" data-amount="{{$itemVoucher->amount}}" data-name="{{$itemVoucher->name}}" data-minimum_order_value="{{$itemVoucher->minimum_order_value}}">Áp dụng</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="form-voucher border border-dark rounded bg-dark text-white form_voucher_css form_freeship_voucher">
        <span class="w-100 d-flex justify-content-end pt-4 pe-3 text-decoration-none btn_close_form_css close_form_freeship_voucher">
            <i class="fa-solid fa-close fa-2xl text-white"></i>
        </span>
        <div class="p-4">
            @foreach ($listFreeshipVoucher as $itemVoucher)
            <div class="d-flex flex-row align-items-center border border-white p-2 rounded mb-3 freeship_item_voucher">
                <div class="w-25 me-2 d-flex flex-row align-items-center">
                    <img src="{{$itemVoucher->image}}" alt="" class="w-100">
                </div>
                <div class="w-50">
                    <div class="lh-lg">
                        <h5 class="m-0">{{$itemVoucher->name}}</h5>
                        <span class="badge border border-white">Code: {{$itemVoucher->code}}</span>
                        <div class="d-flex flex-row">Đơn tối thiểu: <p class="mb-0 ms-1 currency">{{$itemVoucher->minimum_order_value}}</p>
                        </div>
                        <div class="d-flex flex-column align-items-start lh-lg">
                            <span class="badge mb-1 p-0">HSD: {{$itemVoucher->end_date}}</span>
                            <span class="badge mb-0 p-0 text-danger">Hết hạn sau {{$itemVoucher->days_remaining}} ngày</span>
                            <span class="badge mb-0 p-0 text-success">Còn: {{$itemVoucher->quantity}}</span>
                        </div>
                    </div>
                </div>
                <div class="w-25">
                    <span class="btn btn-white text-dark bg-white use_freeship_voucher" data-id="{{$itemVoucher->id}}" data-type="{{$itemVoucher->type}}" data-amount="{{$itemVoucher->amount}}" data-name="{{$itemVoucher->name}}" data-minimum_order_value="{{$itemVoucher->minimum_order_value}}">Áp dụng</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection