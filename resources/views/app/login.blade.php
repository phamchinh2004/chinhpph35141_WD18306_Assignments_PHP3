@extends('app.layouts.loginRegisterLayout')
@section('title', 'Đăng nhập')
@section('content')

<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="border w-50 h-auto d-flex flex-column align-items-center rounded bg-white scroll">
        <a href="{{route('/')}}" class="w-100 d-flex justify-content-end pt-4 pe-3 text-decoration-none text-black">
            <i class="fa-solid fa-close fa-2xl"></i>
        </a>
        <img class="rounded mt-3" src="{{ asset('image/logo-removebg.png') }}" alt="" width="130" height="90">
        <div class="mt-2 text-center">
            <h2>Trải nghiệm mua sắm cùng <b>e-SportsJacket</b></h2>
            <p class="text-black-50">Đã có hơn 10.000 khách hàng tin tưởng mua sắm</p>
        </div>
        <form class="w-75 mt-3 mb-4" action="">
            <div class="form-floating">
                <input class="form-control" type="text" id="username" placeholder="Nhập tên đăng nhập">
                <label for="username">Tên đăng nhập</label>
            </div>
            <div class="form-floating mt-3">
                <input class="form-control" type="password" id="password" placeholder="Nhập mật khẩu">
                <label for="password">Mật khẩu</label>
            </div>
            <div class="mt-4 d-flex justify-content-center">
                <button class="btn btn-success fs-5">Đăng nhập ngay</button>
            </div>
            <div class="text-center mt-2">
                <p>Hoặc</p>
            </div>
            <div class="mt-1 d-flex justify-content-center">
                <a class="btn btn-primary" href="{{route('register')}}">Đăng ký ngay</a>
            </div>
        </form>
    </div>
</div>

@endsection