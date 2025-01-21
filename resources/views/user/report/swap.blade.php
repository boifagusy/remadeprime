@extends('user.layouts.master')
@section('title', 'Airtime Swap')

@section('content')
<div class="card">
    <div class="card-body table-responsive">
      <table class="table w-100" id="dataTable2">
        <thead>
          <tr>            
            <th>#</th>
            <th>Number</th> 
            <th>Network</th>
            <th>Amount</th>  
            <th>Charge</th>        
            <th>TRX Code</th>
            <th>Date</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($trx as $key => $item)
            <tr>
              <td>{{$key + 1}}</td>
              <td>{{($item->number)}} </td>
              <td>{{$item->network->name ?? "Null"}}</td>
              <td>{{format_price($item->amount)}}</td>
              <td>{{format_price($item->charge)}}</td>
              <td>{{$item->code}}</td>
              <td>{{show_datetime($item->created_at)}}</td>
              <td>
                @if($item->status == 1)
                    <span class="badge bg-success">successful</span>
                @elseif ($item->status == 2)
                    <span class="badge bg-warning">pending</span>
                @elseif ($item->status == 3)
                    <span class="badge bg-danger">Declined</span>
                @endif    
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
</div>
@endsection