@extends('app.layouts.userLayout')
@section('title','Trang chủ')
@section('content')
<!-- container -->
<div id="home">
    <!-- banner -->
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div id="categories" class="carousel-indicators">
            @if($banner_images!=null)
            @foreach ($banner_images as $key=> $itemImage)
            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="{{$key}}" class="{{$key==0?'active':''}}" aria-current="{{$key==0?'true':''}}" aria-label="Slide {{$key+1}}"></button>
            @endforeach
            @endif
        </div>
        <div class="carousel-inner">
            @if($banner_images!=null)
            @foreach ($banner_images as $itemImage)
            <a href="#" class="carousel-item active">
                <img src="{{asset('uploads/'.$itemImage->file_name)}}" class="d-block w-100" alt="...">
            </a>
            @endforeach
            @endif
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="container mt-5">
        <!-- Categories -->
        <div class="mb-5">
            <h3 class="text-center fw-bold pb-3 border-bottom border-dark mb-5">Danh mục</h3>
            <div class="row">
                <!-- Items -->
                @foreach ($categories as $category)

                <div class="col-3 d-flex flex-column">
                    <a href="">
                        <img class="w-100 fix-height" src="{{$category->image}}" alt="">
                    </a>
                    <a class="btn btn-white btn-outline-dark w-100 rounded-bottom pt-3 pb-3 mt-3 fs-5 fw-bold">{{$category->name}}</a>
                </div>

                @endforeach
            </div>
            <div class="d-flex justify-content-center mt-3">
                {{$categories->appends(['categories_page'=>request()->input('categories_page')])->links()}}
            </div>
        </div>
        <!-- content1 -->
        <div id="products">
            <h3 class="fw-bold pb-3 border-bottom border-dark">Bán chạy nhất</h3>
            <div class="row mt-5">
                <!-- Items -->
                @foreach ($products as $product)

                <div class="col-2 position-relative mb-4">
                    <span class="badge bg-danger position-absolute end-0 me-2">Hot</span>
                    <a href="{{route('userProductDetail.show',$product->id)}}" class="text-decoration-none">
                        <img class="w-100" src="{{asset('uploads/'.$product->image)}}" alt="">
                        <p class="text-dark text-center border-bottom pb-3 fw-bold mt-3">{{Str::limit($product->name,20)}}</p>
                    </a>
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <div class="text-decoration-line-through mb-1 d-flex flex-row">
                            <p class=" currency">{{$product->purchase_price}}</p>
                        </div>
                        <div class="fs-5 fw-bold d-flex flex-row">
                            <p class=" currency">{{$product->sale_price}}</p>
                        </div>
                        <p class="m-0">Đã bán: {{$product->total_quantity_sold}}</p>
                        <p>Lượt xem: {{$product->view}}</p>
                    </div>
                </div>

                @endforeach
            </div>
            <div class="d-flex justify-content-center">
                {{$products->appends(['products_page'=>request()->input('products_page')])->links()}}
            </div>
        </div>
    </div>
</div>
@endsection