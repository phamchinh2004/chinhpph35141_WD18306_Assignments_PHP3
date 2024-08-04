@extends('app.layouts.adminLayout')
@section('title','Quản lý sản phẩm')
@section('content')
<div class="border bg-dark rounded p-2">
    <h3 class="text-white">Product Management</h3>
    <div class="d-flex justify-content-start">
        <a href="{{route('productsManagerIndex')}}" class="btn btn-dark border border-white"><i class="fas fa-arrow-left me-2"></i>Quay lại</a>
    </div>
    <div>
        <h2>Thêm mới sản phẩm</h2>
        <form action="{{route('createTemporary')}}" class="" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="">Product name</label>
                <input type="text" class="form-control" name="product_name" value="{{old('product_name')}}">
            </div>
            <div class="form-group">
                <label for="">Product image</label>
                <input type="file" class="form-control" name="product_image" value="{{old('product_image')}}">
            </div>
            <div class="form-group">
                <label for="">Purchase price</label>
                <input type="number" class="form-control" name="purchase_price" value="{{old('purchase_price')}}">
            </div>
            <div class="form-group">
                <label for="">Sale price</label>
                <input type="number" class="form-control" name="sale_price" value="{{old('sale_price')}}">
            </div>
            <div class="form-group">
                <label for="">Product name</label>
                <input type="text" class="form-control" name="product_name" value="{{old('product_name')}}">
            </div>
        </form>
    </div>
</div>
@endsection