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
                <li class="breadcrumb-item active" aria-current="page">Thông tin đơn hàng</li>
            </ol>
        </nav>
        <div class="bg-white p-3">
            <div class="d-flex flex-column">
                <h3 class="text-center pt-3 pb-3"><i class="fa-solid fa-circle-info me-2"></i>Thông tin đơn hàng</h3>
                <div class="d-flex flex-column border-top">
                    <div class="d-flex flex-row align-items-center">
                        <i class="fa-solid fa-location-dot fa-md mt-4 me-2 text-danger"></i>
                        <p class="m-0 mt-4 fs-5 text-danger">Địa chỉ nhận hàng</p>
                    </div>
                    <div class="d-flex flex-row align-items-center mt-3">
                        <h5 class="m-0 me-2">{{$orderDetailData['full_name']}}</h5>
                        <h5 class="m-0 me-3">(+84) {{$orderDetailData['phone_number']}}</h5>
                        <p class="m-0 me-3">{{$orderDetailData['address']}}
                        </p>
                    </div>
                </div>
                <div class="d-flex flex-row justify-content-around align-items-center mt-4">
                    <div class="d-flex flex-row align-items-center">
                        <i class="fa-solid fa-truck fa-md me-2"></i>
                        <h5 class="m-0">Nhận hàng từ: 3-5 ngày</h5>
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
                            @foreach ($orderDetailData['product_variants'] as $itemVariant)
                            <tr>
                                <td class="">
                                    <div class="form-check d-flex flex-row align-items-center">
                                        <img class="me-3" src="{{$itemVariant['image']}}" alt="" width="110">
                                        <h6 class="form-check-label">
                                            {{$itemVariant['name']}}
                                        </h6>
                                    </div>
                                </td>
                                <td class="centered">
                                    <div class="d-flex text-center flex-column h-auto">
                                        <span>Phân loại hàng:</span>
                                        <span class="fw-bold">{{$itemVariant['attribute_values']}}</span>
                                    </div>
                                </td>
                                <td class="centered text-center currency">{{$itemVariant['price']}}</td>
                                <td class="centered text-center">{{$itemVariant['quantity']}}</td>

                                <td class="centered text-center text-danger currency">{{$itemVariant['total_price']}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex flex-column justify-content-around align-items-center mt-4">
                        <div class="d-flex flex-row align-items-center">
                            <i class="fa-solid fa-person-running fa-lg me-2"></i>
                            <h5 class="m-0">Phương thức thanh toán</h5>
                        </div>
                        <div>
                            <p class="m-0">Thanh toán khi nhận hàng</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-4 bg-light">
                        <table class="table table-light w-50">
                            <tbody>
                                <tr>
                                    <td>Tổng tiền hàng</td>
                                    <th class="currency">{{$orderDetailData['total_cost']}}</th>
                                </tr>
                                <tr>
                                    <td>Phí vận chuyển
                                    </td>
                                    <th class="currency">{{$orderDetailData['shipping_price']}}</th>
                                </tr>
                                <tr>
                                    <td>Giảm phí vận chuyển
                                    </td>
                                    <th class="currency">{{$orderDetailData['shipping_voucher']}}</th>
                                </tr>
                                <tr>
                                    <td>Voucher từ eSportsJacket
                                    </td>
                                    <th class="currency">{{$orderDetailData['voucher']}}</th>
                                </tr>
                                <tr>
                                    <td class="centered">Thành tiền
                                    </td>
                                    <th class="fs-4 text-danger fw-bold currency">{{$orderDetailData['total_payment']}}</th>
                                </tr>
                                <tr>
                                    <td class="centered">Ngày đặt hàng
                                    </td>
                                    <td>{{$orderDetailData['created_at']}}</td>
                                </tr>
                                <tr>
                                    <td class="centered">Trạng thái
                                    </td>
                                    <td class="text-success">{{$orderDetailData['status']==1?'Chờ xác nhận!':'Không xác định!'}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection