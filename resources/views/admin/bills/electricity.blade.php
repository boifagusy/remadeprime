@extends('admin.layouts.master')
@section('title', 'Manage Electricity')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex align-items-center justify-content-between">
        <h5>Electricity Companies</h5> 
        <a class="btn btn-primary btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#createCompany"><i class="fas fa-plus"></i> New Company</a>
        </div>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover" id="datatable">
            <thead>
                <tr>
                <th>S/N</th>
                <th>Name</th>
                <th>Charges</th>
                <th>Minimum</th>
                <th>Status</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($powers as $key => $item)
                <tr>
                    <td>{{$key +1}}</td>
                    <td>{{$item->name}}</td>
                    <td> {{format_price($item->fee)}}</td>
                    <td> {{format_price($item->minimum)}}</td>
                    <td><span class="badge @if($item->status == 1)bg-success @else bg-danger @endif">@if($item->status == 1)active @else disabled @endif </span></td>
                    <td>
                        <div class="dropstart">
                        <button class="btn btn-light" type="button" id="" data-bs-toggle="dropdown">
                            <i class="fa fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editPlan-{{$item->id}}"  href="#" >@lang('Edit Plan')</a>
                            @if($item->status == 1)                               
                            <a class="dropdown-item" href="{{route('admin.bills.power.status' ,[$item->id, 0])}}">Disable</a> @else                              
                            <a class="dropdown-item" href="{{route('admin.bills.power.status' ,[$item->id, 1])}}">Enable</a>  
                            @endif
                        </div>
                        </div>
                    </td>
                </tr>
                <div class="modal fade" id="editPlan-{{$item->id}}" tabindex="-1"  aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold">Edit Data Plan</h5>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('admin.bills.power.edit', $item->id)}}" enctype="multipart/form-data" method="post">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label">Company Name</label>
                                    <input type="text" class="form-control" name="name" value="{{$item->name}}" placeholder="Plan Name" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Plan Code</label>
                                    <input type="text" class="form-control" name="code" value="{{$item->code}}" placeholder="Plan Code" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Minimum Price</label>
                                    <input type="number" class="form-control" name="minimum" value="{{$item->minimum}}" placeholder="Minimum Price" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Charges/Fee</label>
                                    <input type="number" class="form-control" name="fee" value="{{$item->fee}}" placeholder="Plan Charges" required>
                                </div>
                                <div class="form-group text-end">
                                    <button class="btn btn-success" type="submit">Edit Plan</button>
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
<div class="modal fade" id="createCompany" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title fw-bold">Create Data Plan</h5>
        </div>
        <div class="modal-body">
            <form action="{{route('admin.bills.power.create')}}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="form-group">
                    <label class="form-label">Company Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Plan Name" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Plan Code</label>
                    <input type="text" class="form-control" name="code" placeholder="Plan Code" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Minimum</label>
                    <input type="number" class="form-control" name="minimum" placeholder="Minimum Price" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Charges/Fee</label>
                    <input type="number" class="form-control" name="fee" placeholder="Plan Charges" required>
                </div>
                <div class="form-group text-end">
                    <button class="btn-success btn" type="submit">Create Plan</button>
                </div>
            </form>
        </div>
        </div>
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