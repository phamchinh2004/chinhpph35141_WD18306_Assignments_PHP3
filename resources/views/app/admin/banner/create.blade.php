@extends('app.layouts.adminLayout')
@section('title','Quản lý sản phẩm')
@section('content')
<div class="border bg-dark rounded p-2">
    <h3 class="text-white">Banners Management</h3>
    <div class="d-flex justify-content-start">
        <a href="{{route('bannersManagerIndex')}}" class="btn btn-dark border border-white"><i class="fas fa-arrow-left me-2"></i>Back</a>
    </div>
    <div class="text-white">
        <h4 class="text-center">Add new banner</h4>
        <form action="{{route('storeBanner')}}" id="form_banner_images" enctype="multipart/form-data" method="POST">
            @csrf
            <div>
                <label for="">Name</label>
                <input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="Enter name banner">
                @error('name')
                <div class="mt-2">
                    <span class="text-danger">{{$message}}</span>
                </div>
                @enderror
            </div>
            <div class="d-flex flex-row align-items-end w-100 item_image">
                <div class="flex-grow-1">
                    <label for="image">Image 1</label>
                    <input type="file" name="image[]" class="form-control">
                    @error('image')
                    <div class="mt-2">
                        <span class="text-danger">{{$message}}</span>
                    </div>
                    @enderror
                </div>
                <span class="btn btn-danger ms-2 remove_image_btn">Drop</span>
            </div>
        </form>
        <div class="mt-2">
            <span class="btn btn-dark border-white" id="addImage">Add image</span>
        </div>
        <div class="mt-2">
            <span class="btn btn-success border-success" id="addImageDone">Done</span>
        </div>
    </div>
</div>
@endsection