@extends('app.layouts.userLayout')
@section('title','Chi tiết sản phẩm')
@section('content')
<div class="bg-light pt-3 pb-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-dark text-decoration-none fw-bold" href="userHome.index">Trang chủ</a></li>
                <li class="breadcrumb-item"><a class="text-dark text-decoration-none fw-bold" href="#">Áo khoác</a></li>
                <li class="breadcrumb-item active" aria-current="page">T1 20th Anniv. Special Jacket</li>
            </ol>
        </nav>
        <div class="bg-white d-flex flex-row">
            <div class="d-flex flex-column w-50 justify-content-center border-dotted-end me-3">
                <div>
                    <img class="w-100" src="{{$productDetail->image}}" alt="">
                </div>
                <div class="row d-flex justify-content-center align-items-center mt-3 mb-3">
                    <a href="#" class="col-2 pe-auto">
                        <img class="w-100" src="{{$productDetail->image}}" alt="">
                    </a>
                    <a href="#" class="col-2 pe-auto">
                        <img class="w-100" src="{{$productDetail->image}}" alt="">
                    </a>
                    <a href="#" class="col-2 pe-auto">
                        <img class="w-100" src="{{$productDetail->image}}" alt="">
                    </a>
                    <a href="#" class="col-2 pe-auto">
                        <img class="w-100" src="{{$productDetail->image}}" alt="">
                    </a>
                    <a href="#" class="col-2 pe-auto">
                        <img class="w-100" src="{{$productDetail->image}}" alt="">
                    </a>
                </div>
            </div>
            <div class="w-50 me-3">
                <div class="mt-3">
                    <h3>T1 20th Anniv. Special Jacket</h3>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="d-flex pe-3 border-end">
                                <p class="border-bottom border-danger text-danger m-0">4.5</p>
                                <div class="ms-2">
                                    <i class="fa-solid fa-star" style="color:red;"></i>
                                    <i class="fa-solid fa-star" style="color:red;"></i>
                                    <i class="fa-solid fa-star" style="color:red;"></i>
                                    <i class="fa-solid fa-star" style="color:red;"></i>
                                    <i class="fa-solid fa-star-half-stroke" style="color:red;"></i>
                                </div>
                            </div>
                            <div class="d-flex align-items-center ps-3 pe-3 border-end">
                                <p class="border-bottom border-black text-black me-2 mb-0 fw-bold">132</p>
                                <p class="mb-0">Đánh giá</p>
                            </div>
                            <div class="d-flex align-items-center ps-3 pe-3">
                                <p class="border-bottom border-black text-black me-2 mb-0 fw-bold">720</p>
                                <p class="mb-0">Đã bán <i class="fa-solid fa-circle-question"></i></p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <a class="text-decoration-none" href="">
                                <p class="mb-0 text-black">Tố cáo</p>
                            </a>
                        </div>
                    </div>
                    <div class="bg-light mt-4">
                        <div class="d-flex flex-row align-items-center pt-3 pb-3 ps-3">
                            <div class="d-flex align-items-center position-relative strikethough">
                                <p class="border-bottom border-black mb-0" style="font-size:10px">đ</p>
                                <p class="mb-0">1.000.000</p>
                            </div>
                            <div class="d-flex align-items-center ms-3">
                                <p class="border-bottom border-danger mb-1 fw-bold text-danger me-1">đ</p>
                                <h3 class="mb-0 text-danger">799.000</h3>
                            </div>
                            <div class="d-flex align-items-center ms-3">
                                <span class="badge bg-danger text-white">20% giảm</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 d-flex flex-row align-items-center">
                        <p class="text-secondary mb-0 w-25">Deal sốc</p>
                        <span class="badge bg-danger pt-2 pb-2">Mua để nhận ưu đãi</span>
                    </div>
                    <div class="mt-4 d-flex flex-row align-items-center">
                        <p class="text-secondary mb-0 w-25">Vận chuyển</p>
                        <img src="{{asset('image/component/freeShip.png')}}" alt="" width="20">
                        <p class="ms-1 mb-0">Miễn phí vận chuyển</p>
                    </div>
                    <div class="mt-4 d-flex flex-row align-items-center">
                        <p class="text-secondary mb-0 w-25">Tên</p>
                        <div class="row row-cols-4 w-75">
                            <a href="#" class="col border-black border text-decoration-none text-black mt-3 ms-3 w-auto">
                                <div class="d-flex align-items-center flex-row h-100">
                                    <img src="{{asset('image/products/product1.jpg')}}" alt="" width="35px">
                                    <p class="mb-0" style="font-size:14px">FAKER</p>
                                </div>
                            </a>
                            <a href="#" class="col border-black border text-decoration-none text-black mt-3 ms-3 w-auto">
                                <div class="d-flex align-items-center flex-row">
                                    <img src="{{asset('image/products/product1.jpg')}}" alt="" width="35px">
                                    <p class="mb-0" style="font-size:14px">ZEUS</p>
                                </div>
                            </a>
                            <a href="#" class="col border-black border text-decoration-none text-black mt-3 ms-3 w-auto">
                                <div class="d-flex align-items-center flex-row">
                                    <img src="{{asset('image/products/product1.jpg')}}" alt="" width="35px">
                                    <p class="mb-0" style="font-size:14px">ONER</p>
                                </div>
                            </a>
                            <a href="#" class="col border-black border text-decoration-none text-black mt-3 ms-3 w-auto">
                                <div class="d-flex align-items-center flex-row">
                                    <img src="{{asset('image/products/product1.jpg')}}" alt="" width="35px">
                                    <p class="mb-0" style="font-size:14px">GUMAYUSI</p>
                                </div>
                            </a>
                            <a href="#" class="col border-black border text-decoration-none text-black mt-3 ms-3 w-auto">
                                <div class="d-flex align-items-center flex-row">
                                    <img src="{{asset('image/products/product1.jpg')}}" alt="" width="35px">
                                    <p class="mb-0" style="font-size:14px">KERIA</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div>
                        <div class="mt-4 d-flex flex-row align-items-center">
                            <p class="text-secondary mb-0 w-25">Size</p>
                            <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-4 d-flex flex-row align-items-center pt-3">
                                <div class="col text-center border border-black p-0 cs-pt ms-3 mb-3 w-auto">
                                    <p class="mb-0 ps-3 pe-3 pt-1 pb-1">S</p>
                                </div>
                                <div class="col text-center border border-black p-0 cs-pt ms-3 mb-3 w-auto">
                                    <p class="mb-0 ps-3 pe-3 pt-1 pb-1">M</p>
                                </div>
                                <div class="col text-center border border-black p-0 cs-pt ms-3 mb-3 w-auto">
                                    <p class="mb-0 ps-3 pe-3 pt-1 pb-1">L</p>
                                </div>
                                <div class="col text-center border border-black p-0 cs-pt ms-3 mb-3 w-auto">
                                    <p class="mb-0 ps-3 pe-3 pt-1 pb-1">XL</p>
                                </div>
                                <div class="col text-center border border-black p-0 cs-pt ms-3 mb-3 w-auto">
                                    <p class="mb-0 ps-3 pe-3 pt-1 pb-1">XXL</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-row mt-4">
                        <div class="w-25 text-white">abc</div>
                        <div class="w-75 d-flex align-items-end">
                            <a href="#" class="text-dark text-decoration-none">Bảng quy đổi kích cỡ<i class="fa-solid fa-chevron-right ms-2"></i></a>
                        </div>
                    </div>
                    <div class="mt-4 d-flex align-items-center flex-row">
                        <p class="text-secondary mb-0 w-25">Số lượng</p>
                        <form class="d-flex flex-row" action="#" >
                            <button class="btn btn-outline-dark btn-white" style="width:40px;">-</button>
                            <input type="text" class="form-control text-align-center" style="width:60px;" value="1">
                            <button class="btn btn-outline-dark btn-white"style="width:40px;">+</button>
                        </form>
                        <p class="mb-0 ms-3">3670 sản phẩm có sẵn</p>
                    </div>
                    <div class="d-flex align-items-center mt-4">
                        <div class="me-4">
                            <a href="{{route('addToCart',$productDetail->id)}}" class="btn btn-white btn-outline-dark p-3 fw-bold"><i class="fa-solid fa-cart-plus me-2"></i>Thêm vào giỏ hàng</a>
                        </div>
                        <div class="me-4">
                            <a href="#" class="btn btn-white btn-outline-dark ps-5 pe-5 pt-3 pb-3 fw-bold">Mua ngay</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection