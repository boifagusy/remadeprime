@extends('admin.layouts.master')
@section('title', 'Airtime Sales')

@section('content')
<div class="card">
   <div class="card-body table-responsive">
    <table class="table table-bordered" id="datatable">
        <thead>
            <tr>            
              <th>#</th>
              <th>User</th>
              <th>Number</th> 
              <th>Network</th>
              <th>Amount</th>          
              <th>TRX Code</th>
              <th>Date</th>
              <th>Status</th>
              <th>Details</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($trx as $key => $item)
              <tr>
                <td>{{$key + 1}}</td>
                <td>{{$item->user->username ?? "Null"}}</td>
                <td>{{($item->number)}} </td>
                <td>{{$item->network->name ?? "Null"}}</td>
                <td>{{format_price($item->amount)}}</td>
                <td>{{$item->code}}</td>
                <td>{{show_datetime($item->created_at)}}</td>
                <td>
                  @if($item->status == 1)
                      <span class="badge bg-success">successful</span>
                  @elseif ($item->status == 2)
                      <span class="badge bg-warning">pending</span>
                  @elseif ($item->status == 3)
                      <span class="badge bg-danger">cancelled</span>
                  @endif    
                </td>
                <td>{{$item->name}}</td>
              </tr>
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
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Sales</a></li>
                    <li class="breadcrumb-item active">@yield('title')</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
@endsection