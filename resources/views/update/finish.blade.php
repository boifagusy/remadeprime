@extends('admin.layouts.master')
@section('title', 'System Update')

@section('content')
<div class="row justify-content-center">
    <div class="col-xl-8 mx-auto">
        <div class="card">
            <div class="card-body">
                <div class="text-center">
                    <h1 class="h3">{{ __('Congratulations') }}</h1>
                    <p>
                        {{ __('You have successfully completed the updating process.') }}
                    </p>
                </div>
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