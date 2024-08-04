@extends('app.layouts.adminLayout')
@section('title','Quản lý sản phẩm')
@section('content')
<div class="border bg-dark rounded p-2">
    <h3 class="text-white">Product Management</h3>
    <div class="d-flex justify-content-end">
        <a href="{{route('createProduct')}}" class="btn btn-success"><i class="fas fa-plus me-2"></i>Create</a>
    </div>
    <div class="table-container scroll-x">
        <table class="table table-hover table-dark mt-4 border ">
            <thead>
                <tr class="text-center">
                    <th class="text-center">STT</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Image</th>
                    <th class="text-center">Purchase price</th>
                    <th class="text-center">Sale price</th>
                    <th class="text-center">Category</th>
                    <th class="text-center">Total variants</th>
                    <th class="text-center">Description</th>
                    <th class="text-center">Control</th>
                </tr>
            </thead>
            <tbody>
                @if ($listOfProducts!=null)
                @foreach ($listOfProducts as $itemProduct)
                <tr>
                    <td class="text-center">{{++$i}}</td>
                    <td class="text-center">{{$itemProduct->name}}</td>
                    <td>
                        <div>
                            <img src="{{$itemProduct->image}}" alt="" width="100px">
                        </div>
                    </td>
                    <td class="text-center currency">{{$itemProduct->purchase_price}}</td>
                    <td class="text-center currency">{{$itemProduct->sale_price}}</td>
                    <td class="text-center">{{$itemProduct->category_name}}</td>
                    <td class="text-center">{{$itemProduct->total_variants}}</td>
                    <td class="text-center">{{$itemProduct->description}}</td>
                    <td>
                        <div class="d-flex justity-content-between align-items-center">
                            <span class="btn btn-dark border border-white"><i class="fas fa-eye"></i></span>
                            <span class="btn btn-warning border border-white ms-2"><i class="fas fa-pen-to-square text-white"></i></span>
                            <form action="{{route('deleteProduct',$itemProduct->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger border border-white ms-2"><i class="fas fa-ban"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $listOfProducts->links() }}
        </div>
    </div>
</div>
@endsection