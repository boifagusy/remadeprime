@extends('admin.layouts.master')
@section('title', 'System Update')

@section('content')
<div class="row justify-content-center">
    <div class="col-xl-8 mx-auto">
        <div class="card">
            <div class="card-header d-sm-flex justify-content-between">
                <h1 class="h5 mb-0">Update Process</h1>
            </div>
            @error('update_file')
                <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                    Please upload a zip file.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div> 
            @enderror
            @if(Session::get('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                {{Session::get('error')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="card-body">
                <div class="text-center mb-2">
                    <b>Take note of the following details before proceeding.</b>
                </div>
                <ol class="list-group">
                    <li class="list-group-item text-semibold"><i class="fa fa-check me-2"></i>{{__('Make a backup of your database.')}}</li>
                    <li class="list-group-item text-semibold"><i class="fa fa-check me-2"></i>{{__('Download latest version.')}}</li>
                    <li class="list-group-item text-semibold"><i class="fa fa-check me-2"></i>{{__('Extract the downloaded zip file . You will find an update.zip file in the extrated files.')}}</li>
                    <li class="list-group-item text-semibold"><i class="fa fa-check me-2"></i>{{__('Upload that zip file here and click update now.')}}</li>
                    <li class="list-group-item text-semibold"><i class="fa fa-check me-2"></i>{{__('Please turn on maintainance mode before updating')}}</li>
                </ol>
                <br>               
                <form action="{{ route('admin.update.postfile') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="form-label fw-bold ">{{__('Upload File zip')}}</label>
                        <input type="file" required class="form-control" name="update_file" placeholder="Upload file here">
                    </div>
                    <br>
                    <div class="text-center">
                        <button class="btn btn-primary" type="submit">{{__('Update')}}</button>
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
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Update</a></li>
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
    .img-table{ height:50px ;}
    .card-header{background-color: #fefefe; border-bottom:1px solid #949d94 }
</style>
@endsection