@extends('app.layouts.userLayout')
@section('title','Chi tiết sản phẩm')
@section('content')
<div class="bg-light pt-3 pb-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-dark text-decoration-none fw-bold" href="{{route('userHome.index')}}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a class="text-dark text-decoration-none fw-bold" href="#">Áo khoác</a></li>
                <li class="breadcrumb-item active" aria-current="page">T1 20th Anniv. Special Jacket</li>
            </ol>
        </nav>
        <div class="bg-white d-flex flex-row">
            <div class="d-flex flex-column w-50 justify-content-center border-dotted-end me-3">
                @if ($productDetail->image)
                <div>
                    <img class="w-100 main-image xzoom" src="{{$productDetail->image}}" alt="" xoriginal="{{$productDetail->image}}">
                </div>
                <div class="row d-flex justify-content-center align-items-center mt-3 mb-3 xzoom-thumbs">
                    <a class="col-2 pe-auto">
                        <img class="w-75 sub_image_first xzoom-gallery" src="{{$productDetail->image}}" alt="" xpreview="{{$productDetail->image}}">
                    </a>
                    @foreach ($productImages as $productImage)
                    @if ( $productImage->image)
                    <a class="col-2 pe-auto">
                        <img class="w-75  sub_image_second xzoom-gallery" src="{{$productImage->image}}" alt="" xpreview="{{$productImage->image}}">
                    </a>
                    @endif
                    @endforeach
                </div>
                @endif
            </div>
            <div class="w-50 me-3">
                <div class="mt-3">
                    <h3>{{$productDetail->name}}</h3>
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
                                <p class="mb-0 update-purchase-price">{{$productDetail->purchase_price}}</p>
                            </div>
                            <div class="d-flex align-items-center ms-3">
                                <p class="border-bottom border-danger mb-1 fw-bold text-danger me-1">đ</p>
                                <h3 class="mb-0 text-danger update-sale-price">{{$productDetail->sale_price}}</h3>
                            </div>
                            <div class="ms-3">
                                <span class="badge bg-danger text-white d-flex align-items-center">
                                    <p class="update-percent-discount m-0">{{100-($productDetail->sale_price/$productDetail->purchase_price*100)}}</p>% giảm
                                </span>
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
                    <input type="number" class="total_attributes" value="{{count($array_attributes)}}" hidden>
                    <input type="number" class="product_id" value="{{$productDetail->id}}" hidden>
                    @foreach ($array_attributes as $attribute_item)
                    <div class="mt-4 d-flex flex-row align-items-center">
                        <p class="text-secondary mb-0 w-25">{{$attribute_item['name']}}</p>
                        <div class="row row-cols-4 w-75 attribute_group" data-id="{{$attribute_item['id']}}">
                            @foreach ($attribute_item['attribute_values'] as $attribute_value_item)
                            <div class="col border-black border text-decoration-none text-black ms-3
                             w-auto border-secondary-subtle attribute_item attribute-value-hover cs-pt" data-id="{{$attribute_value_item['id']}}">
                                <div class="d-flex align-items-center flex-row h-100">
                                    @if($attribute_value_item['image']!=null)
                                    <img src="{{$attribute_value_item['image']}}" alt="" width="35px">
                                    @endif
                                    <p class="mb-0 pt-2 pb-2 text-center" style="font-size:14px;min-width:15px;">{{$attribute_value_item['value']}}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                    <div class="d-flex flex-row mt-4">
                        <div class="w-25 text-white">abc</div>
                        <div class="w-75 d-flex align-items-end">
                            <a href="#" class="text-dark text-decoration-none">Bảng quy đổi kích cỡ<i class="fa-solid fa-chevron-right ms-2"></i></a>
                        </div>
                    </div>
                    <div class="mt-4 d-flex align-items-center flex-row">
                        <p class="text-secondary mb-0 w-25">Số lượng</p>
                        <form class="d-flex flex-row" action="#">
                            <button class="btn btn-outline-dark btn-white" style="width:40px;">-</button>
                            <input type="text" class="form-control text-align-center" style="width:60px;" value="1">
                            <button class="btn btn-outline-dark btn-white" style="width:40px;">+</button>
                        </form>
                        <p class="ms-3">
                        <p class="mb-0 update-stock me-1">{{$total_stock}}</p>sản phẩm có sẵn</p>
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