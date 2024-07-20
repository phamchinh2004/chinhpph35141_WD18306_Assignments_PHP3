@extends('app.layouts.userLayout')
@section('title','Thanh toán')
@section('content')
<div class="bg-light pt-3 pb-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-dark text-decoration-none fw-bold" href="{{route('userHome')}}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a class="text-dark text-decoration-none fw-bold" href="{{route('userCart')}}">Giỏ hàng</a></li>
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
                        <h5 class="m-0 me-2">Phạm Chình</h5>
                        <h5 class="m-0 me-3">(+84) 987654321</h5>
                        <p class="m-0 me-3">Số 24, Ngõ 199 Cầu Diễn, Phường Phúc Diễn, Quận Bắc Từ Liêm, Hà Nội
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
                            <tr class="">
                                <td class="">
                                    <div class="form-check d-flex flex-row align-items-center">
                                        <img class="me-3" src="{{asset('image/products/product1.jpg')}}" alt="" width="110">
                                        <h6 class="form-check-label">
                                            T1 20th Anniv. Special Jacket
                                        </h6>
                                    </div>
                                </td>
                                <td class="centered">
                                    <div class="d-flex text-center flex-column h-auto">
                                        <span>Phân loại hàng:</span>
                                        <span class="fw-bold">Faker,M</span>
                                    </div>
                                </td>
                                <td class="centered text-center">100.000đ</td>
                                <td class="centered text-center">1</td>

                                <td class="centered text-center text-danger">100.000đ</td>
                            </tr>
                            <tr class="">
                                <td class="">
                                    <div class="form-check d-flex flex-row align-items-center">
                                        <img class="me-3" src="{{asset('image/products/product1.jpg')}}" alt="" width="110">
                                        <h6 class="form-check-label">
                                            T1 20th Anniv. Special Jacket
                                        </h6>
                                    </div>
                                </td>
                                <td class="centered">
                                    <div class="d-flex text-center flex-column h-auto">
                                        <span>Phân loại hàng:</span>
                                        <span class="fw-bold">Faker,M</span>
                                    </div>
                                </td>
                                <td class="centered text-center">100.000đ</td>
                                <td class="centered text-center">1</td>

                                <td class="centered text-center text-danger">100.000đ</td>
                            </tr>
                            <tr class="">
                                <td class="">
                                    <div class="form-check d-flex flex-row align-items-center">
                                        <img class="me-3" src="{{asset('image/products/product1.jpg')}}" alt="" width="110">
                                        <h6 class="form-check-label">
                                            T1 20th Anniv. Special Jacket
                                        </h6>
                                    </div>
                                </td>
                                <td class="centered">
                                    <div class="d-flex text-center flex-column h-auto">
                                        <span>Phân loại hàng:</span>
                                        <span class="fw-bold">Faker,M</span>
                                    </div>
                                </td>
                                <td class="centered text-center">100.000đ</td>
                                <td class="centered text-center">1</td>

                                <td class="centered text-center text-danger">100.000đ</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="d-flex flex-row justify-content-around">
                        <div class="d-flex flex-row align-items-center">
                            <i class="fa-solid fa-ticket fa-md me-2"></i>
                            <h5 class="m-0">VOUCHER</h5>
                        </div>
                        <button class="btn btn-white btn-outline-dark">Chọn voucher</button>
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
                                    <th>₫385.339</th>
                                </tr>
                                <tr>
                                    <td>Phí vận chuyển
                                    </td>
                                    <th>₫42.800</th>
                                </tr>
                                <tr>
                                    <td>Giảm phí vận chuyển
                                    </td>
                                    <th>-₫0</th>
                                </tr>
                                <tr>
                                    <td>Voucher từ eSportsJacket
                                    </td>
                                    <th>-₫0</th>
                                </tr>
                                <tr>
                                    <td class="centered">Tổng thanh toán
                                    </td>
                                    <th class="fs-4 text-danger fw-bold">₫428.139</th>
                                </tr>
                                <tr>
                                    <th colspan="2" class="text-center">
                                        <a href="{{route('userOrder')}}" class="btn btn-danger ps-5 pe-5 pt-2 pb-2 fw-bold">
                                            Đặt hàng
                                        </a>
                                    </th>
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