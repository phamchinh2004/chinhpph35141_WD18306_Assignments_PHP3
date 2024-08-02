@extends('app.layouts.loginRegisterLayout')
@section('title', 'Đăng nhập')
@section('content')

<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="border w-50 h-auto d-flex flex-column align-items-center rounded bg-white scroll">
        <a href="{{route('userHome.index')}}" class="w-100 d-flex justify-content-end pt-4 pe-3 text-decoration-none text-black">
            <i class="fa-solid fa-close fa-2xl"></i>
        </a>
        <img class="rounded mt-3" src="{{ asset('image/logo-removebg.png') }}" alt="" width="130" height="90">
        @if (session('message'))
        {{session('message')}}
        @endif
        <div class="mt-2 text-center">
            <h2>Trải nghiệm mua sắm cùng <b>e-SportsJacket</b></h2>
            <p class="text-black-50">Đã có hơn 10.000 khách hàng tin tưởng mua sắm</p>
        </div>
        <form class="w-75 mt-3 mb-4" action="{{route('login')}}" method="post">
            @csrf
            <div class="form-floating">
                <input class="form-control" type="text" name="username" value="{{old('username')}}" placeholder="Nhập tên đăng nhập">
                <label for="username">Tên đăng nhập</label>
                @error('username')
                <span class="text-danger" style="font-size:11px;">
                    <strong>*{{$message}}</strong>
                </span>
                @enderror
            </div>
            <div class="form-floating mt-3">
                <input class="form-control" type="password" name="password" value="{{old('password')}}" placeholder="Nhập mật khẩu">
                <label for="password">Mật khẩu</label>
                @error('password')
                <span class="text-danger" style="font-size:11px;">
                    <strong>*{{$message}}</strong>
                </span>
                @enderror
            </div>
            <div class="mt-4 d-flex justify-content-center">
                <button class="btn btn-success fs-5" type="submit">Đăng nhập ngay</button>
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