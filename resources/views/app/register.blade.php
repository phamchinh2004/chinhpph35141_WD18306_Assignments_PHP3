@extends('app.layouts.loginRegisterLayout')
@section('title', 'Đăng ký')
@section('content')

<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="border w-50 h-auto d-flex flex-column align-items-center rounded bg-white scroll">
        <a href="{{route('/')}}" class="w-100 d-flex justify-content-end pt-4 pe-3 text-decoration-none text-black">
            <i class="fa-solid fa-close fa-2xl"></i>
        </a>
        <img class="rounded mt-3" src="{{ asset('image/logo-removebg.png') }}" alt="" width="100">
        <div class="mt-2 text-center">
            <h3>Trải nghiệm mua sắm cùng <b>e-SportsJacket</b></h3>
            <p class="text-black-50">Đã có hơn 10.000 khách hàng tin tưởng mua sắm</p>
        </div>
        <form class="w-75 mt-3 mb-4" action="{{route('register.post')}}" method="post">
            @csrf
            <div class="form-floating mt-3">
                <input class="form-control" type="text" name="fullname" placeholder="Nhập họ và tên">
                <label for="fullname">Họ và tên</label>
                @error('fullname')
                <span class="text-danger" style="font-size:11px;">
                    <strong>*{{$message}}</strong>
                </span>
                @enderror
            </div>
            <div class="form-floating mt-3">
                <input class="form-control" type="email" name="email" placeholder="Nhập email">
                <label for="email">Email</label>
                @error('email')
                <span class="text-danger" style="font-size:11px;">
                    <strong>*{{$message}}</strong>
                </span>
                @enderror
            </div>
            <div class="form-floating mt-3">
                <input class="form-control" type="text" name="address" placeholder="Nhập email">
                <label for="address">Địa chỉ</label>
                @error('address')
                <span class="text-danger" style="font-size:11px;">
                    <strong>*{{$message}}</strong>
                </span>
                @enderror
            </div>
            <div class="form-floating mt-3">
                <input class="form-control" type="number" name="phone" placeholder="Nhập email">
                <label for="phone">Số điện thoại</label>
                @error('phone')
                <span class="text-danger" style="font-size:11px;">
                    <strong>*{{$message}}</strong>
                </span>
                @enderror
            </div>
            <div class="form-floating mt-3">
                <input class="form-control" type="text" name="username" placeholder="Nhập tên đăng nhập">
                <label for="username">Tên đăng nhập</label>
                @error('username')
                <span class="text-danger" style="font-size:11px;">
                    <strong>*{{$message}}</strong>
                </span>
                @enderror
            </div>
            <div class="form-floating mt-3">
                <input class="form-control" type="password" name="password" placeholder="Nhập mật khẩu">
                <label for="password">Mật khẩu</label>
                @error('password')
                <span class="text-danger" style="font-size:11px;">
                    <strong>*{{$message}}</strong>
                </span>
                @enderror
            </div>
            <div class="form-floating mt-3">
                <input class="form-control" type="password" name="repassword" placeholder="Nhập lại mật khẩu">
                <label for="repassword">Nhập lại mật khẩu</label>
                @error('repassword')
                <span class="text-danger" style="font-size:11px;">
                    <strong>*{{$message}}</strong>
                </span>
                @enderror
            </div>
            <div class="mt-4 d-flex justify-content-center">
                <button class="btn btn-primary fs-5" type="submit"><i class="fa-solid fa-plus fa-sm me-2"></i>Đăng ký ngay</button>
            </div>
            <div class="text-center mt-2">
                <p>Hoặc</p>
            </div>
            <div class="d-flex justify-content-center">
                <a class="btn btn-success" href="{{route('login')}}">Đăng nhập ngay</a>
            </div>
        </form>
    </div>
</div>
@endsection