@extends('app.layouts.adminLayout')
@section('title','Quản lý sản phẩm')
@section('content')
<div class="border bg-dark rounded p-2">
    <h3 class="text-white">Product Management</h3>
    <div class="d-flex justify-content-start">
        <a href="{{route('productsManagerIndex')}}" class="btn btn-dark border border-white"><i class="fas fa-arrow-left me-2"></i>Back</a>
    </div>
    <div class="text-white">
        <h4 class="text-center">Edit product</h4>
        <form action="{{route('updateProduct',$product->id)}}" class="lh-lg" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="">Product name</label>
                <input type="text" class="form-control" name="name" value="{{$product->name}}" placeholder="Enter product name">
                @error('name')
                <span class="text-danger" style="font-size:11px;">
                    <strong>*{{$message}}</strong>
                </span>
                @enderror
            </div>
            <div class="d-flex flex-row">
                <div class="w-50">
                    <div class="form-group">
                        <label for="">Product image</label>
                        <input type="file" class="form-control" name="image">
                        @error('image')
                        <span class="text-danger" style="font-size:11px;">
                            <strong>*{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Purchase price</label>
                        <input type="number" class="form-control" name="purchase_price" value="{{$product->purchase_price}}" placeholder="Enter product purchase price">
                        @error('purchase_price')
                        <span class="text-danger" style="font-size:11px;">
                            <strong>*{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Sale price</label>
                        <input type="number" class="form-control" name="sale_price" value="{{$product->sale_price}}" placeholder="Enter product sale price">
                        @error('sale_price')
                        <span class="text-danger" style="font-size:11px;">
                            <strong>*{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea class="form-control"  name="description" value="" id="" placeholder="Enter product description">{{$product->description}}</textarea>
                        <!-- <input type="text" class="form-control" name="description" value="{{$product->description}}" placeholder="Enter product description"> -->
                        @error('description')
                        <span class="text-danger" style="font-size:11px;">
                            <strong>*{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Category</label>
                        <select name="category_id" id="" class="form-select">
                            @foreach ($categories as $itemCat)
                            <option value="{{$itemCat->id}}" {{$itemCat->id==$product->category_id?'selected':''}}>{{$itemCat->name}}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <span class="text-danger" style="font-size:11px;">
                            <strong>*{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="d-flex flex-column justify-content-center align-items-center w-50">
                    <label for="">Old product image</label>
                    <img src="{{asset('uploads/'.$product->image)}}" alt="" width="300px">
                </div>
            </div>

            <div class="d-flex justify-content-center mt-3">
                <button class="btn btn-success" type="submit">Done</button>
            </div>
        </form>
    </div>
</div>
@endsection