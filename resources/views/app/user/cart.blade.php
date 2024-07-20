@extends('app.layouts.userLayout')
@section('title','Giỏ hàng')
@section('content')
<div class="bg-light pt-3 pb-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-dark text-decoration-none fw-bold" href="#">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
            </ol>
        </nav>
        <div class="bg-white">
            <div class="d-flex flex-column">
                <div class="d-flex justify-content-center align-items-center pt-5 pb-5">
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
                                @foreach ($productCart as $product)

                                <tr class="">
                                    <td class="">
                                        <div class="form-check d-flex flex-row align-items-center">
                                            <input class="form-check-input me-3 product-checkbox checkBoxProduct" type="checkbox">
                                            <img class="me-3" src="{{$product->product->image}}" alt="" width="110">
                                            <h6 class="form-check-label">
                                                {{$product->product->name}}
                                            </h6>
                                        </div>
                                    </td>
                                    <td class="centered">
                                        <div class="d-flex text-center flex-column h-auto">
                                            <span>Phân loại hàng:</span>
                                            <span class="fw-bold">Faker,M</span>
                                        </div>
                                    </td>
                                    <td class="centered text-center">{{$product->product->sale_price}}đ</td>
                                    <td class="centered">
                                        <div class="d-flex flex-row justify-content-center">
                                            <button class="btn btn-outline-dark btn-white" style="width:30px;">-</button>
                                            <input type="text" class="form-control text-align-center" style="width:40px;" value="{{$product->quantity}}">
                                            <button class="btn btn-outline-dark btn-white" style="width:30px;">+</button>
                                        </div>
                                    </td>
                                    <td class="centered text-center">{{$product->product->sale_price}}đ</td>
                                    <td class="centered">
                                        <div class="d-flex justify-content-center">
                                            <button class="btn btn-danger">Xóa</button>
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
                                                Chọn tất cả ({{$productCart->count()}})
                                            </label>
                                            <button class="btn btn-dark btn-outline-light ms-2" id="deleteAllSelectRecord">Xóa</button>
                                        </div>
                                    </th>
                                    <th>Tổng thanh toán ({{$productCart->count()}} sản phẩm)</th>
                                    <th>
                                        <div class="d-flex align-items-center ms-3">
                                            <p class="border-bottom border-white mb-1 fw-bold text-white me-1">đ</p>
                                            <h3 class="mb-0 text-white">{{$total_payment}}</h3>
                                        </div>
                                    </th>
                                    <th>
                                        <a href="{{route('userPayment')}}" class="btn btn-dark border-white btn-outline-light pt-3 pb-3 ps-5 pe-5 fw-bold">Mua hàng</a>
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