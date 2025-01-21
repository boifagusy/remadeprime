@extends('admin.layouts.master')
@section('title') {{$user->username}} Transactions @endsection

@section('content')
<div class="card">
    <div class="card-body table-responsive">
     <table class="table table-hover" id="datatable">
         <thead>
             <tr>         
                 <th>#</th>
                 <th>Type</th>           
                 <th>TRX Code</th>
                 <th>Date</th>
                 <th>Amount</th>
                 <th>Status</th>
                 <th>Details</th>
             </tr>
         </thead>
         <tbody>
             @foreach ($trx as $key => $item)
             <tr>
                 <td>{{$key +1}}</td>
                 <td> {!! trans_type($item->type) !!}</td>
                 <td>{{$item->code}} </td>
                 <td> {{show_date($item->created_at)}}</td> 
                 <td>{{format_price($item->amount)}} </td>
                 <td>
                     @if($item->status == 1)
                         <span class="badge bg-success">successful</span>
                     @elseif ($item->status == 2)
                         <span class="badge bg-warning">pending</span>
                     @elseif ($item->status == 3)
                         <span class="badge bg-danger">cancelled</span>
                     @endif    
                 </td>
                 <td><a class="btn btn-sm btn-info" href="#" data-bs-toggle="modal" data-bs-target="#trxDetail{{$item->id}}" >View</a></td>
             </tr>
             <div class="modal fade" id="trxDetail{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                 <div class="modal-dialog">
                     <div class="modal-content">
                         <div class="modal-header py-0">
                             <h4 class="modal-title" id="myModalLabel"> Transaction Details</h4>
                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                         </div>
                         <div class="modal-body">
                             <div class="row">
                                 <p> Transaction ID : {{$item->code}} </p>
                                 <p class="col-sm-6"> Date : {{show_datetime($item->created_at)}} </p>
                                 <p class="col-sm-6"> Status :  @if($item->status == 1)
                                     <span class="badge bg-success">successful</span> @elseif ($item->status == 2) <span class="badge bg-warning">pending</span> @elseif ($item->status == 3) <span class="badge bg-danger">cancelled</span>  @endif   
                                 </p>
                                 <p class="col-6"> Amount : {{format_price($item->amount)}} </p>
                                 <p class="col-6"> Charge : {{format_price($item->charge)}} </p>
                                 <p class="col-6">Type : {!! trans_type($item->type) !!} </p>
                                 <p class="col-6">Service : <span class="badge bg-info">{{short_trx_type($item->service)}} </span> </p>
                                 <p class="col-sm-12"> Details : {{$item->message}} </p>
                             </div>
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
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                    <li class="breadcrumb-item active">@yield('title')</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
@endsection