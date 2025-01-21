@extends('admin.layouts.master')
@section('title', 'Airtime Swap')

@section('content')
<div class="card">
    <h5 class="card-header">All Networks</h5>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover" id="datatable">
            <thead>
                <tr>
                <th>S/N</th>
                <th>Name</th>
                <th>Image</th>
                <th>Rate</th>
                <th>Number</th>
                <th>Status</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($networks as $key => $network)
                <tr>
                    <td>{{$key +1}}</td>
                    <td>{{$network->name}}</td>
                    <td><img loading="lazy"  class="img-table" src="{{my_asset($network->image)}}" alt="{{$network->name}}"> </td>
                    <td>{{$network->rate}}</td>
                    <td>{{$network->number ?? "Nill"}}</td>
                    <td><span class="badge @if($network->swap == 1)bg-success @else bg-danger @endif">@if($network->swap == 1)active @else disabled @endif </span></td>
                    <td>
                        <div class="dropstart">
                        <button class="btn btn-light" type="button" id="" data-bs-toggle="dropdown">
                            <i class="fa fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_modal-{{$network->id}}"  href="#" >@lang('Edit')</a>
                            @if($network->swap == 1)                               
                            <a class="dropdown-item" href="{{route('admin.bills.swap.status' ,[$network->id, 0])}}">Disable</a> @else                              
                            <a class="dropdown-item" href="{{route('admin.bills.swap.status' ,[$network->id, 1])}}">Enable</a>  
                            @endif
                        </div>
                        </div>
                    </td>
                </tr>
                {{-- edit modals --}}
                <div class="modal fade" id="edit_modal-{{$network->id}}" tabindex="-1"  aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold">Edit Network</h5>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('admin.bills.swap.update',$network->id)}}" enctype="multipart/form-data" method="post">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label">Transfer Number</label>
                                    <input type="number" class="form-control" name="number" placeholder="Swap Number" value="{{$network->number}}" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Swap Rate</label>
                                    <input type="number" class="form-control" name="rate" placeholder="Transfer rate" value="{{$network->rate}}" required>
                                </div>
                                <div class="form-group text-end">
                                    <button class="btn-success btn" type="submit">Update</button>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('breadcrumb')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">@yield('title')</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Bills</a></li>
                    <li class="breadcrumb-item active">@yield('title')</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
@endsection

@section('scripts')
@endsection
@section('styles')
<style>
    .img-table{ height:40px ;}
    .card-header{background-color: #fefefe; border-bottom:1px solid #949d94 }
</style>
@endsection