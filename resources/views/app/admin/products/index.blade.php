@extends('app.layouts.adminLayout')
@section('title','Quản lý sản phẩm')
@section('content')
<div class="container border bg-dark rounded pt-2">
    <h3 class="text-white">Product Management</h3>
    <div class="d-flex justify-content-end">
        <a href="#" class="btn btn-success"><i class="fas fa-plus me-2"></i>Create</a>
    </div>
    <table class="table table-hover table-dark mt-4 border">
        <thead>
            <tr class="text-center">
                <th>STT</th>
                <th>Name</th>
                <th>Image</th>
                <th>Price</th>
                <th>Description</th>
                <th>Category</th>
                <th>Control</th>
            </tr>
        </thead>
    </table>
</div>
@endsection