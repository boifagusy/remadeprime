@extends('admin.layouts.master')
@section('title', 'API Settings')

@section('content')
<h5 class="card-header text-center mb-2">API Settings</h5>
<div class="row">
    <div class="col-sm-6">
        <div class="card">
            <h6 class="card-header">GSUBZ API</h6>
            <div class="card-body">
                <form action="{{route('admin.setting.env_key')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="GSUBZ_API">
                        <label class="form-label">API Key</label>
                        <input type="text" class="form-control" name="GSUBZ_API" value="{{ env('GSUBZ_API') }}" placeholder="GSUBZ API Key">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success w-100" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">
            <h6 class="card-header">FATIZARA API</h6>
            <div class="card-body">
                <form action="{{route('admin.setting.env_key')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="FATI_USERNAME">
                        <label class="form-label">API Username</label>
                        <input type="text" class="form-control" name="FATI_USERNAME" value="{{ env('FATI_USERNAME') }}" placeholder="FATIZARA USERNAME">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="FATI_PASS">
                        <label class="form-label">API Password</label>
                        <input type="text" class="form-control" name="FATI_PASS" value="{{ env('FATI_PASS') }}" placeholder="FATIZARA PASSWORD">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success w-100" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0 h6 text-center">Select API</h3>
            </div>
            <div class="card-body text-center">
                <span class="float-start">GSUBZ</span>
                <label class="jdv-switch jdv-switch-warning mb-0">
                    <input type="checkbox" onchange="updateSystem(this, 'vend_api')" @if(sys_setting('vend_api') == 1) checked @endif >
                    <span class="slider round"></span>
                </label>
                <span class="float-end">Fatizara</span>
            </div>
        </div>
    </div>
</div>

<h5 class="text-center card-header mb-2 ">Services Activation</h5>
<div class="row">
    <div class="col-sm-6 col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0 h6 text-center">Data</h3>
            </div>
            <div class="card-body text-center">
                <label class="jdv-switch jdv-switch-success mb-0">
                    <input type="checkbox" onchange="updateSystem(this, 'is_data')" @if(sys_setting('is_data') == 1) checked @endif >
                    <span class="slider round"></span>
                </label>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0 h6 text-center">Airtime</h3>
            </div>
            <div class="card-body text-center">
                <label class="jdv-switch jdv-switch-success mb-0">
                    <input type="checkbox" onchange="updateSystem(this, 'is_airtime')" @if(sys_setting('is_airtime') == 1) checked @endif >
                    <span class="slider round"></span>
                </label>
            </div>
        </div>
    </div>
    
    <div class="col-sm-6 col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0 h6 text-center">Cable TV</h3>
            </div>
            <div class="card-body text-center">
                <label class="jdv-switch jdv-switch-success mb-0">
                    <input type="checkbox" onchange="updateSystem(this, 'is_cable')" @if(sys_setting('is_cable') == 1) checked @endif >
                    <span class="slider round"></span>
                </label>
            </div>
        </div>
    </div>
    
    <div class="col-sm-6 col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0 h6 text-center">Education</h3>
            </div>
            <div class="card-body text-center">
                <label class="jdv-switch jdv-switch-success mb-0">
                    <input type="checkbox" onchange="updateSystem(this, 'is_education')" @if(sys_setting('is_education') == 1) checked @endif >
                    <span class="slider round"></span>
                </label>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0 h6 text-center">Electricity</h3>
            </div>
            <div class="card-body text-center">
                <label class="jdv-switch jdv-switch-success mb-0">
                    <input type="checkbox" onchange="updateSystem(this, 'is_electricity')" @if(sys_setting('is_electricity') == 1) checked @endif >
                    <span class="slider round"></span>
                </label>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0 h6 text-center">Bulk SMS</h3>
            </div>
            <div class="card-body text-center">
                <label class="jdv-switch jdv-switch-success mb-0">
                    <input type="checkbox" onchange="updateSystem(this, 'is_bulksms')" @if(sys_setting('is_bulksms') == 1) checked @endif >
                    <span class="slider round"></span>
                </label>
            </div>
        </div>
    </div>
    
    <div class="col-sm-6 col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0 h6 text-center">Airtime to Cash</h3>
            </div>
            <div class="card-body text-center">
                <label class="jdv-switch jdv-switch-success mb-0">
                    <input type="checkbox" onchange="updateSystem(this, 'airtime_cash')" @if(sys_setting('airtime_cash') == 1) checked @endif >
                    <span class="slider round"></span>
                </label>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0 h6 text-center">Airtime PIN</h3>
            </div>
            <div class="card-body text-center">
                <label class="jdv-switch jdv-switch-success mb-0">
                    <input type="checkbox" onchange="updateSystem(this, 'airtime_pin')" @if(sys_setting('airtime_pin') == 1) checked @endif >
                    <span class="slider round"></span>
                </label>
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
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                    <li class="breadcrumb-item active">@yield('title')</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
@endsection

@section('scripts')
<script>        
    function updateSystem(el, name){
        if($(el).is(':checked')){
            var value = 1;
        }
        else{
            var value = 0;
        }
        $.post('{{ route('admin.setting.sys_settings') }}', {_token:'{{ csrf_token() }}', name:name, value:value}, function(data){
            if(data == '1'){
                Snackbar.show({
                    text: '{{__('Settings Updated Successfully')}}',
                    pos: 'top-right',
                    backgroundColor: '#38c172'
                });
            }
            else{
                Snackbar.show({
                    text: '{{__('Something went wrong')}}',
                    pos: 'top-right',
                    backgroundColor: '#e3342f'
                });
            }
        });
    }
</script>
@endsection
@section('styles')
<style>
    .card-header{background-color: #fefefe; border-bottom:1px solid #949d94 }
</style>
@endsection