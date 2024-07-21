@extends('app.layouts.userLayout')
@section('title','Trang chủ')
@section('content')
<!-- container -->
<div id="home">
    <!-- banner -->
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div id="categories" class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="3" aria-label="Slide 4"></button>
            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="4" aria-label="Slide 5"></button>
        </div>
        <div class="carousel-inner">
            <a href="#" class="carousel-item active">
                <img src="{{asset('image/banner/banner1.jpg')}}" class="d-block w-100" alt="...">
            </a>
            <a href="#" class="carousel-item">
                <img src="{{asset('image/banner/banner2.jpg')}}" class="d-block w-100" alt="...">
            </a>
            <a href="#" class="carousel-item">
                <img src="{{asset('image/banner/banner3.jpg')}}" class="d-block w-100" alt="...">
            </a>
            <a href="#" class="carousel-item">
                <img src="{{asset('image/banner/banner4.jpg')}}" class="d-block w-100" alt="...">
            </a>
            <a href="#" class="carousel-item">
                <img src="{{asset('image/banner/banner5.jpg')}}" class="d-block w-100" alt="...">
            </a>
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

                <div class="col-3">
                    <a href="">
                        <img class="w-100 fix-height" src="{{$category->image}}" alt="">
                    </a>
                    <a class="btn btn-white btn-outline-dark w-100 rounded-bottom pt-3 pb-3 mt-3 fs-5 fw-bold" href="">{{$category->name}}</a>
                </div>

                @endforeach
            </div>
            <div class="d-flex justify-content-center mt-3">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link text-dark" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link text-dark" href="#">1</a></li>
                        <li class="page-item"><a class="page-link text-dark" href="#">2</a></li>
                        <li class="page-item"><a class="page-link text-dark" href="#">3</a></li>
                        <li class="page-item"><a class="page-link text-dark" href="#">Next</a></li>
                    </ul>
                </nav>
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
                        <img class="w-100" src="{{$product->image}}" alt="">
                        <p class="text-dark text-center border-bottom pb-3 fw-bold mt-3">{{$product->name}}...</p>
                    </a>
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <p class="text-decoration-line-through mb-1">đ{{$product->purchase_price}}</p>
                        <p class="fs-5 fw-bold">đ{{$product->sale_price}}</p>
                        <p>Đã bán: {{$product->total_quantity}}</p>
                    </div>
                    <div>
                        <a class="btn btn-white btn-outline-dark w-100 pt-2 pb-2">Thêm vào giỏ hàng</a>
                    </div>
                </div>

                @endforeach
            </div>
            <div class="d-flex justify-content-center">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link text-dark" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link text-dark" href="#">1</a></li>
                        <li class="page-item"><a class="page-link text-dark" href="#">2</a></li>
                        <li class="page-item"><a class="page-link text-dark" href="#">3</a></li>
                        <li class="page-item"><a class="page-link text-dark" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection