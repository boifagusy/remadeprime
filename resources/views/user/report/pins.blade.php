@extends('user.layouts.master')
@section('title', 'Recharge Pins')

@section('content')
<div class="card">
  {{-- <div class="card-header">
    <div class="d-flex align-items-center justify-content-between">                                
      <h5 class="strong">Download</h5>
      <div class="">
        <a class="btn btn-primary btn-sm" onclick="cardPdf()">
          PDF <i class="fa fa-file-pdf"></i>
        </a>
        <a onclick="cardExcel()" type="button" class="btn btn-secondary btn-sm">
          Excel <i class="fa fa-file-excel"></i>
        </a>

        <a onclick ="cardPrint()" type="button" class="btn btn-success btn-sm">
          Print <i class="fa fa-print"></i>
        </a>

      </div>  
    </div> 
  </div> --}}
    <div class="card-body table-responsive">
      <table class="table w-100" id="dataTable exportTable">
        <thead>
          <tr>            
            <th>#</th>
            <th>Network</th>
            <th>Value</th>
            <th>Serial</th> 
            <th>Pin</th>       
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($pins as $key => $item)
            <tr>
              <td>{{$key + 1}}</td>
              <td>{{$trx->network->name ?? "None"}}</td>
              <td>{{format_price($trx->cost)}}</td>
              <td>{{$item->sn}} </td>
              <td>{{$item->pin}}</td>
              <td>{{$trx->created_at}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
</div>
@endsection
@section('scripts')

@endsection