@extends('app.layouts.adminLayout')
@section('title','Quản lý sản phẩm')
@section('content')
<div class="border bg-dark rounded p-2">
    <h3 class="text-white">Order Management</h3>
    <div class="table-container scroll-x">
        <table class="table table-hover table-dark mt-4 border ">
            <thead>
                <tr class="text-center">
                    <th class="text-center">STT</th>
                    <th class="text-center">User id</th>
                    <th class="text-center">User name</th>
                    <th class="text-center">Total cost</th>
                    <th class="text-center">Shipping price</th>
                    <th class="text-center">Shipping Voucher</th>
                    <th class="text-center">Order</th>
                    <th class="text-center">Total payment</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Created at</th>
                    <th class="text-center">Updated at</th>
                    <th class="text-center">Control</th>
                </tr>
            </thead>
            <tbody>
                @if ($orders!=null)
                @foreach ($orders as $key=> $itemOrder)
                <tr>
                    <td class="text-center">{{$key}}</td>
                    <td class="text-center">{{$itemOrder->user_id}}</td>
                    <td class="text-center">{{$itemOrder->username}}</td>
                    <td class="text-center currency">{{$itemOrder->total_cost}}</td>
                    <td class="text-center currency">{{$itemOrder->shipping_price}}</td>
                    <td class="text-center currency">{{$itemOrder->shipping_voucher}}</td>
                    <td class="text-center currency">{{$itemOrder->voucher}}</td>
                    <td class="text-center currency">{{$itemOrder->total_payment}}</td>
                    <td class="text-center">
                        @if($itemOrder->status==1)
                        <span class="badge text-warning bg-white">Pending confirmation...</span>
                        @elseif($itemOrder->status==2)
                        <span class="badge text-success bg-white">Confirmed</span>
                        @else
                        <span class="badge text-danger bg-white">Cancelled</span>
                        @endif
                    </td>
                    <td class="text-center">{{$itemOrder->created_at}}</td>
                    <td class="text-center">{{$itemOrder->updated_at}}</td>
                    <td class="control-cell">
                        <div class="d-flex justify-content-end align-items-center">
                            <form action="{{route('updateStatusOrder',$itemOrder->id)}}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div>
                                    @if($itemOrder->status==1)
                                    <button class="btn btn-success" type="submit">Confirm</button>
                                    @elseif($itemOrder->status==2)
                                    <button class="btn btn-danger" type="submit">Cancel</button>
                                    @else
                                    <span class="badge text-danger bg-white">Cancelled</span>
                                    @endif
                                </div>
                            </form>
                            <span class="btn btn-dark border border-white ms-2"><i class="fas fa-eye"></i></span>
                            <a href="{{route('editOrder',$itemOrder->id)}}" class="btn btn-warning border border-white ms-2"><i class="fas fa-pen-to-square text-white"></i></a>
                        </div>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection