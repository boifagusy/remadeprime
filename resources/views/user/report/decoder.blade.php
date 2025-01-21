@extends('user.layouts.master')
@section('title', 'Power Payment Logs')

@section('content')
<div class="card">
    <div class="card-body table-responsive">
      <table class="table w-100" id="dataTable2">
        <thead>
          <tr>           
            <th>IUC Number</th> 
            <th>Decoder</th>
            <th>Amount</th>
            <th>Package</th>      
            <th>TRX Code</th>
            <th>Date</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($trx as $key => $item)
            <tr>
              <td>{{($item->number)}} </td>
              <td>{{$item->decoder->name ?? "Null"}}</td>
              <td>{{format_price($item->amount)}}</td>
              <td>{{$item->name ?? "Null"}}</td>
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
            </tr>
            {{-- modal --}}
            <div class="modal fade" id="trxDetail{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header py-0">
                        <h6 class="modal-title" id="myModalLabel"> Transaction Details</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                          <p> <b>Transaction ID </b> : {{$item->code}} </p>
                          <p class="col-sm-6"><b> Date :</b> {{show_datetime($item->created_at)}} </p>
                          <p class="col-sm-6"> <b>Status : </b> @if($item->status == 1)
                              <span class="badge bg-success">successful</span> @elseif ($item->status == 2) <span class="badge bg-warning">pending</span> @elseif ($item->status == 3) <span class="badge bg-danger">cancelled</span>  @endif   
                          </p>
                          <p class="col-6"> <b>Amount :</b> {{format_price($item->amount)}} </p>
                          <p class="col-6"> <b>Charge :</b> {{format_price($item->charge)}} </p>
                          <p class="col-6"><b>Type :</b>{!! trans_type($item->type) !!} </p>
                          <p class="col-6"><b>Service :</b> <span class="badge bg-info">{{short_trx_type($item->service)}} </span> </p>
                          <p class="col-sm-12"><b>Details :</b> {{$item->message}} </p>
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