@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="row">
    <div class="col-sm-6 col-lg-3">
        <div class="card text-center">
            <div class="card-body p-t-10">
                <h4 class="card-title text-muted mb-0">System Balance</h4>
                <h4 class="mt-3 mb-2"><b>{{format_price($users->sum('balance'))}}</b></h4>
                <p class="text-muted mb-0 mt-3"></p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card text-center">
            <div class="card-body p-t-10">
                <h4 class="card-title text-muted mb-0">Referral Balance</h4>
                <h4 class="mt-3 mb-2"><b>{{format_price($users->sum('bonus'))}}</b></h4>
                <p class="text-muted mb-0 mt-3"></p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card text-center">
            <div class="card-body p-t-10">
                <h4 class="card-title text-muted mb-0">Credit Transactions</h4>
                <h4 class="mt-3 mb-2 text-success"><b>{{format_price($transactions->where('type', 1)->sum('amount'))}}</b></h4>
                <p class="text-muted mb-0 mt-3"></p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card text-center">
            <div class="card-body p-t-10">
                <h4 class="card-title text-muted mb-0">Debit Transactions</h4>
                <h4 class="mt-3 mb-2 text-danger"><b>{{format_price($transactions->where('type', 2)->sum('amount'))}}</b></h4>
                <p class="text-muted mb-0 mt-3"></p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card text-center">
            <div class="card-body">
                <h4 class="card-title text-muted">Total Users</h4>
                <h4 class="mt-3 mb-2"><b>{{$users->count()}}</b></h4>
                <p class="text-muted mb-0 mt-3"><b>{{(App\Models\User::whereYear('created_at', date('Y'))->whereMonth('created_at', date('m'))->whereDay('created_at', date('d'))->whereBlocked(0)->whereUserRole('user')->count())}}</b> Today</p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card text-center">
            <div class="card-body p-t-10">
                <h4 class="card-title text-muted mb-0">Manual Deposits</h4>
                <h4 class="mt-3 mb-2"><b>{{format_price($mpayment->where('status', 1)->sum('amount'))}}</b></h4>
                <p class="text-muted mb-0 mt-3"><b>{{format_price(App\Models\Mdeposit::whereYear('updated_at', date('Y'))->whereMonth('updated_at', date('m'))->whereDay('updated_at', date('d'))->where('status', 1)->sum('amount'))}}</b> Today</p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card text-center">
            <div class="card-body p-t-10">
                <h4 class="card-title text-muted mb-0">Total Deposits</h4>
                <h4 class="mt-3 mb-2"><b>{{format_price($deposit->where('status', 1)->sum('amount'))}}</b></h4>
                <p class="text-muted mb-0 mt-3"><b>{{format_price(App\Models\Deposit::whereYear('updated_at', date('Y'))->whereMonth('updated_at', date('m'))->whereDay('updated_at', date('d'))->where('status', 1)->sum('amount'))}}</b> Today</p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card text-center">
            <div class="card-body p-t-10">
                <h4 class="card-title text-muted mb-0">Pending Deposits</h4>
                <h4 class="mt-3 mb-2"><b>{{format_price($mpayment->where('status', 2)->sum('amount'))}}</b></h4>
                <p class="text-muted mb-0 mt-3"><b>{{format_price(App\Models\Mdeposit::whereYear('updated_at', date('Y'))->whereMonth('updated_at', date('m'))->whereDay('updated_at', date('d'))->where('status', 2)->sum('amount'))}}</b> Today</p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <h5 class="fw-bold">Bills Transactions</h5>
    <div class="col-6 col-lg-3">
        <div class="card text-center">
            <div class="card-body p-t-10">
                <h4 class="card-title text-muted mb-0">Airtime Trxs</h4>
                <h5 class="mt-3 mb-2"><b>{{format_price($networktrx->where('type',1)->where('status', 1)->sum('amount'))}}</b></h5>
                <p class="text-muted mb-0 mt-3"><b>{{format_price(App\Models\NetworkTrx::whereYear('updated_at', date('Y'))->whereMonth('updated_at', date('m'))->whereDay('updated_at', date('d'))->where('type',1)->where('status', 1)->sum('amount'))}}</b> Today</p>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card text-center">
            <div class="card-body p-t-10">
                <h4 class="card-title text-muted mb-0">Data Trxs</h4>
                <h5 class="mt-3 mb-2"><b>{{format_price($networktrx->where('type',2)->where('status', 1)->sum('amount'))}}</b></h5>
                <p class="text-muted mb-0 mt-3"><b>{{format_price(App\Models\NetworkTrx::whereYear('updated_at', date('Y'))->whereMonth('updated_at', date('m'))->whereDay('updated_at', date('d'))->where('type',2)->where('status', 1)->sum('amount'))}}</b> Today</p>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card text-center">
            <div class="card-body p-t-10">
                <h4 class="card-title text-muted mb-0">Airtime Swap</h4>
                <h5 class="mt-3 mb-2"><b>{{format_price($networktrx->where('type',3)->where('status', 1)->sum('amount'))}}</b></h5>
                <p class="text-muted mb-0 mt-3"><b>{{format_price(App\Models\NetworkTrx::whereYear('updated_at', date('Y'))->whereMonth('updated_at', date('m'))->whereDay('updated_at', date('d'))->where('type',3)->where('status', 1)->sum('amount'))}}</b> Today</p>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card text-center">
            <div class="card-body p-t-10">
                <h4 class="card-title text-muted mb-0">Cable Trx</h4>
                <h5 class="mt-3 mb-2"><b>{{format_price(App\Models\DecoderTrx::where('status', 1)->sum('amount'))}}</b></h5>
                <p class="text-muted mb-0 mt-3"><b>{{format_price(App\Models\DecoderTrx::whereYear('updated_at', date('Y'))->whereMonth('updated_at', date('m'))->whereDay('updated_at', date('d'))->where('status', 1)->sum('amount'))}}</b> Today</p>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card text-center">
            <div class="card-body p-t-10">
                <h4 class="card-title text-muted mb-0">Recharge Cards</h4>
                <h5 class="mt-3 mb-2"><b>{{format_price(App\Models\RechargePin::where('status', 1)->sum('amount'))}}</b></h5>
                <p class="text-muted mb-0 mt-3"><b>{{format_price(App\Models\RechargePin::whereYear('updated_at', date('Y'))->whereMonth('updated_at', date('m'))->whereDay('updated_at', date('d'))->where('status', 1)->sum('amount'))}}</b> Today</p>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card text-center">
            <div class="card-body p-t-10">
                <h4 class="card-title text-muted mb-0">Electricity Trx</h4>
                <h5 class="mt-3 mb-2"><b>{{format_price(App\Models\PowerTrx::where('status', 1)->sum('amount'))}}</b></h5>
                <p class="text-muted mb-0 mt-3"><b>{{format_price(App\Models\PowerTrx::whereYear('updated_at', date('Y'))->whereMonth('updated_at', date('m'))->whereDay('updated_at', date('d'))->where('status', 1)->sum('amount'))}}</b> Today</p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        @php
            $swaptrx = App\Models\NetworkTrx::whereType(3)->whereStatus(2)->orderByDesc('id')->limit(10)->get();
        @endphp
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h5>Airtime Swaps</h5>
                    <a href="{{route('admin.reports.swap')}}" class="btn btn-primary btn-sm">View All</a>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered" id="datatable">
                    <thead>
                        <tr>            
                          <th>#</th>
                          <th>User</th>
                          <th>Number</th> 
                          <th>Network</th>
                          <th>Amount</th> 
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($swaptrx as $key => $item)
                          <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$item->user->username ?? "Null"}}</td>
                            <td>{{($item->number)}} </td>
                            <td>{{$item->network->name ?? "Null"}}</td>
                            <td>{{format_price($item->amount)}}</td>
                            <td>
                              <div class="dropstart">
                                <button class="btn btn-light" type="button" id="" data-bs-toggle="dropdown">
                                    <i class="fa fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu">
                                    @if($item->status == 2)  
                                    <a class="dropdown-item" href="{{route('admin.reports.swap.approve',$item->id)}}" title="pay">Approve</a>
                                    <a class="dropdown-item" href="{{route('admin.reports.swap.delete',$item->id)}}" title="delete">Reject</a>
                                    @endif 
                                  </div>
                              </div>  
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                </table> 
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h5>Manual Deposits</h5>
                    <a href="{{route('admin.mdeposits')}}" class="btn btn-primary btn-sm">View All</a>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered" id="datatable1">
                    <thead>
                        <tr>         
                            <th>#</th>
                            <th>TRX ID</th>
                            <th>User</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Details</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($mpayment as $key => $item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$item->code}}</td>
                            <td>{{$item->user->username}}</td>
                            <td>{{format_price($item->amount)}}</td>
                            <td>{{show_datetime($item->created_at)}}</td>
                            <td>{{$item->message}}</td>
                            <td>
                                @if($item->status == 1)
                                    <span class="badge bg-success">@lang('Complete')</span>
                                @elseif ($item->status == 2)
                                    <span class="badge bg-warning">@lang('Pending')</span>
                                @elseif ($item->status == 3)
                                    <span class="badge bg-danger">@lang('Reject')</span>
                                @endif    
                            </td>
                            <td>
                                <div class="dropstart">
                                    <button class="btn btn-light" type="button" id="" data-bs-toggle="dropdown">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        @if($item->status == 2)  
                                        <a class="dropdown-item" href="{{route('admin.mdeposit.pay',$item->id)}}" title="pay">Confirm</a>
                                        <a class="dropdown-item" href="{{route('admin.mdeposit.reject',$item->id)}}" title="delete">Reject</a>
                                        @endif 
                                        {{-- <a class="dropdown-item" href="{{route('admin.mdeposit.delete',$item->id)}}" title="delete">Delete </a> --}}
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#manualReceipt{{$item->id}}" >View</a>  
                                    </div>
                                </div>                      
                            </td>
                        </tr>
                        {{-- Modal --}}
                        <div class="modal fade" id="manualReceipt{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel"> Payment Receipt</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="{{my_asset($item->image)}}" alt="" class="man-img">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa fa-times"></i> @lang('Close')</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table> 
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h5>Recent Users</h5>
                    <a href="{{route('admin.users.index')}}" class="btn btn-primary btn-sm">View All</a>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover table-bordered" id="datatable2">
                    <thead>
                        <tr>         
                            <th>#</th>
                            <th>Information</th>
                            <th>Balance</th>
                            <th>User Since</th>
                            <th>Status </th>
                            <th>Actions </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $item)
                        <tr>
                            <td>{{ $key +1 }}</td>
                            <td>
                                <p>Name : {{ text_trim($item->name, 25) }} </p>
                                <p>Email : {{ $item->email }} </p>
                                <p>Username : {{ $item->username }} </p>
                            </td>
                            {{-- <td> {{isset($item->package->name) ? $item->package->name : "None"}} --}}
                            </td>
                            <td> {{format_price($item->balance) }} </td>
                            <td>{{$item->created_at->diffForHumans()}}</td>
                            <td><span class="badge @if($item->suspend == 1)bg-danger @else bg-primary @endif">@if($item->suspend == 1)banned @else active @endif </span></td>
                            <td>
                                <div class="dropstart">
                                    <button class="btn btn-light" type="button" id="" data-bs-toggle="dropdown">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{route('admin.users.view' ,$item->id )}}">@lang('Details')</a>
                                        {{-- <a class="dropdown-item" href="{{route('users.edit' ,$item->id )}}">@lang('Edit')</a> --}}
                                        @if($item->suspend != 1)                               
                                        <a class="dropdown-item" href="{{route('admin.users.ban' ,[$item->id, 1])}}">@lang('Ban')</a> @else                              
                                        <a class="dropdown-item" href="{{route('admin.users.ban' ,[$item->id, 0])}}">@lang('Unban')</a>  
                                        @endif                      
                                        <a class="dropdown-item" href="{{route('admin.users.delete' ,$item->id )}}">@lang('Delete')</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table> 
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
@section('styles')
<style>
    .man-img{ width:100%;height: auto;    }
    .card-header{background-color: #fefefe; border-bottom:1px solid #949d94 }
</style>
@endsection