@extends('app.layouts.adminLayout')
@section('title','Quản lý sản phẩm')
@section('content')
<div class="border bg-dark rounded p-2">
    <h3 class="text-white">Voucher Management</h3>
    <div class="d-flex justify-content-end">
        <a href="{{route('createVoucher')}}" class="btn btn-success"><i class="fas fa-plus me-2"></i>Create</a>
    </div>
    <div class="table-container scroll-x">
        <table class="table table-hover table-dark mt-4 border ">
            <thead>
                <tr class="text-center">
                    <th class="text-center">STT</th>
                    <th class="text-center">Image</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Code</th>
                    <th class="text-center">Amount</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">Minimum order value</th>
                    <th class="text-center">Type</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Start date</th>
                    <th class="text-center">End date</th>
                    <th class="text-center">Created at</th>
                    <th class="text-center">Updated at</th>
                    <th class="text-center">Control</th>
                </tr>
            </thead>
            <tbody>
                @if ($vouchers!=null)
                @foreach ($vouchers as $key=> $itemVoucher)
                <tr>
                    <td class="text-center">{{$key}}</td>
                    <td>
                        @if (file_exists(public_path('uploads/'.$itemVoucher->image)))
                        <img src="{{asset('uploads/'.$itemVoucher->image)}}" alt="" width="100px">
                        @else
                        <img src="{{$itemVoucher->image}}" alt="" width="100px">
                        @endif
                    </td>
                    <td class="text-center">{{Str::limit($itemVoucher->name,20)}}</td>
                    <td class="text-center">{{$itemVoucher->code}}</td>
                    <td class="text-center">
                        @if($itemVoucher->type=='percent')
                        <span class="text-white fw-bold">{{$itemVoucher->amount}}%</span>
                        @else
                        <span class="text-white currency fw-bold">{{$itemVoucher->amount}}</span>
                        @endif
                    </td>
                    <td class="text-center">{{$itemVoucher->quantity}}</td>
                    <td class="text-center currency">{{$itemVoucher->minimum_order_value}}</td>
                    <td class="text-center">{{$itemVoucher->type}}</td>
                    <td class="text-center">
                        @if($itemVoucher->is_active==1)
                        <span class="badge text-success bg-white">Active</span>
                        @else
                        <span class="badge text-danger bg-white">Inactive</span>
                        @endif
                    </td>
                    <td class="text-center">{{$itemVoucher->start_date}}</td>
                    <td class="text-center">{{$itemVoucher->end_date}}</td>
                    <td class="text-center">{{$itemVoucher->created_at}}</td>
                    <td class="text-center">{{$itemVoucher->updated_at}}</td>
                    <td class="control-cell">
                        <div class="d-flex justify-content-center align-items-center">
                            <form action="{{route('updateStatusVoucher',$itemVoucher->id)}}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div>
                                    @if($itemVoucher->is_active==1)
                                    <button class="btn btn-success" type="submit"><i class="fas fa-toggle-on"></i></button>
                                    @else
                                    <button class="btn btn-danger" type="submit"><i class="fas fa-toggle-off"></i></button>
                                    @endif
                                </div>
                            </form>
                            <span class="btn btn-dark border border-white ms-2"><i class="fas fa-eye"></i></span>
                            <a href="{{route('editVoucher',$itemVoucher->id)}}" class="btn btn-warning border border-white ms-2"><i class="fas fa-pen-to-square text-white"></i></a>
                            <form id="disableForm-{{ $itemVoucher->id }}" action="{{route('deleteVoucher',$itemVoucher->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <span class="btn btn-danger border border-white ms-2 onclickDisable" data-id="{{ $itemVoucher->id }}"><i class="fas fa-trash"></i></spa>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $vouchers->links() }}
        </div>
    </div>
</div>
@endsection