@extends('app.layouts.adminLayout')
@section('title','Quản lý sản phẩm')
@section('content')
<div class="border bg-dark rounded p-2">
    <h3 class="text-white">Banner Management</h3>
    <div class="d-flex justify-content-end">
        <a href="{{route('createBanner')}}" class="btn btn-success"><i class="fas fa-plus me-2"></i>Create</a>
    </div>
    <div class="table-container scroll-x">
        <table class="table table-hover table-dark mt-4 border ">
            <thead>
                <tr class="text-center">
                    <th class="text-center">STT</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Total images</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Created at</th>
                    <th class="text-center">Updated at</th>
                    <th class="text-center">Control</th>
                </tr>
            </thead>
            <tbody>
                @if ($banners!=null)
                @foreach ($banners as $key=> $itemBanner)
                <tr>
                    <td class="text-center">{{$key}}</td>
                    <td class="text-center">{{Str::limit($itemBanner->name,40)}}</td>
                    <td class="text-center">{{$itemBanner->total_images}}</td>
                    <td class="text-center">
                        @if($itemBanner->is_active==1)
                        <span class="badge text-success bg-white">Active</span>
                        @else
                        <span class="badge text-danger bg-white">Inactive</span>
                        @endif
                    </td>
                    <td class="text-center">{{$itemBanner->created_at}}</td>
                    <td class="text-center">{{$itemBanner->updated_at}}</td>
                    <td class="control-cell">
                        <div class="d-flex justify-content-center align-items-center">
                            <form action="{{route('updateStatusBanner',$itemBanner->id)}}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div>
                                    @if($itemBanner->is_active==1)
                                    <button class="btn btn-success" type="submit"><i class="fas fa-toggle-on"></i></button>
                                    @else
                                    <button class="btn btn-danger" type="submit"><i class="fas fa-toggle-off"></i></button>
                                    @endif
                                </div>
                            </form>
                            <span class="btn btn-dark border border-white ms-2"><i class="fas fa-eye"></i></span>
                            <a href="{{route('editBanner',$itemBanner->id)}}" class="btn btn-warning border border-white ms-2"><i class="fas fa-pen-to-square text-white"></i></a>
                            <form id="disableForm-{{ $itemBanner->id }}" action="{{route('deleteBanner',$itemBanner->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <span class="btn btn-danger border border-white ms-2 onclickDisable" data-id="{{ $itemBanner->id }}"><i class="fas fa-trash"></i></spa>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $banners->links() }}
        </div>
    </div>
</div>
@endsection