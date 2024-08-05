@extends('app.layouts.adminLayout')
@section('title','Quản lý sản phẩm')
@section('content')
<div class="border bg-dark rounded p-2">
    <h3 class="text-white">Vouchers Management</h3>
    <div class="d-flex justify-content-start">
        <a href="{{route('vouchersManagerIndex')}}" class="btn btn-dark border border-white"><i class="fas fa-arrow-left me-2"></i>Back</a>
    </div>
    <div class="text-white mb-4">
        <h4 class="text-center">Add new voucher</h4>
        <div class="d-flex justify-content-center lh-lg">
            <form class="w-50" action="{{route('storeVoucher')}}" enctype="multipart/form-data" method="POST">
                @csrf
                <div>
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="Enter name voucher">
                    @error('name')
                    <div class="mt-2">
                        <span class="text-danger">{{$message}}</span>
                    </div>
                    @enderror
                </div>
                <div>
                    <label for="image">Image</label>
                    <input type="file" name="image" class="form-control">
                    @error('image')
                    <div class="mt-2">
                        <span class="text-danger">{{$message}}</span>
                    </div>
                    @enderror
                </div>
                <div>
                    <label for="">Code</label>
                    <input type="text" name="code" class="form-control" value="{{old('code')}}" placeholder="Enter code voucher">
                    @error('code')
                    <div class="mt-2">
                        <span class="text-danger">{{$message}}</span>
                    </div>
                    @enderror
                </div>
                <div>
                    <label for="">Amount</label>
                    <input type="number" name="amount" class="form-control" value="{{old('amount')}}" placeholder="Enter amount voucher">
                    @error('amount')
                    <div class="mt-2">
                        <span class="text-danger">{{$message}}</span>
                    </div>
                    @enderror
                </div>
                <div>
                    <label for="">Quantity</label>
                    <input type="number" name="quantity" class="form-control" value="{{old('quantity')}}" placeholder="Enter quantity voucher">
                    @error('quantity')
                    <div class="mt-2">
                        <span class="text-danger">{{$message}}</span>
                    </div>
                    @enderror
                </div>
                <div>
                    <label for="">Minimum order value</label>
                    <input type="number" name="minimum_order_value" class="form-control" value="{{old('minimum_order_value')}}" placeholder="Enter minimum order value voucher">
                    @error('minimum_order_value')
                    <div class="mt-2">
                        <span class="text-danger">{{$message}}</span>
                    </div>
                    @enderror
                </div>
                <div>
                    <label for="">Type</label>
                    <select name="type" id="" class="form-select">
                        <option value="percent" {{old('type')=='percent'?'selected':''}}>Percent</option>
                        <option value="fixed" {{old('type')=='fixed'?'selected':''}}>Fixed</option>
                        <option value="free_ship" {{old('type')=='free_ship'?'selected':''}}>Free ship</option>
                    </select>
                    @error('type')
                    <div class="mt-2">F
                        <span class="text-danger">{{$message}}</span>
                    </div>
                    @enderror
                </div>
                <div>
                    <label for="">Start date</label>
                    <input type="date" name="start_date" class="form-control" value="{{old('start_date')}}" placeholder="Enter start date voucher">
                    @error('start_date')
                    <div class="mt-2">
                        <span class="text-danger">{{$message}}</span>
                    </div>
                    @enderror
                </div>
                <div>
                    <label for="">End date</label>
                    <input type="date" name="end_date" class="form-control" value="{{old('end_date')}}" placeholder="Enter end date voucher">
                    @error('end_date')
                    <div class="mt-2">
                        <span class="text-danger">{{$message}}</span>
                    </div>
                    @enderror
                </div>
                <div class="mt-2 d-flex justify-content-center">
                    <button class="btn btn-success" type="submit">DONE</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection