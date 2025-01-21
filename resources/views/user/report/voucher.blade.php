@extends('user.layouts.master')
@section('title', 'Recharge Pins')

@section('content')
<div class="card">
    <div class="card-body table-responsive">
      <table class="table w-100" id="dataTable2">
        <thead>
          <tr>            
            <th>#</th>
            <th>Network</th>
            <th>Amount</th> 
            <th>Quantity</th>         
            <th>TRX Code</th>
            <th>Date</th>
            <th>Status</th>
            <th>Pins</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($trx as $key => $item)
            <tr>
              <td>{{$key + 1}}</td>
              <td>{{$item->network->name ?? "None"}}</td>
              <td>{{format_price($item->amount)}}</td>
              <td>{{($item->quantity)}} </td>
              <td>{{$item->code}}</td>
              <td>{{show_datetime($item->created_at)}}</td>
              <td>
                @if($item->status == 1)
                    <span class="badge bg-success">success</span>
                @elseif ($item->status == 2)
                    <span class="badge bg-warning">pending</span>
                @elseif ($item->status == 3)
                    <span class="badge bg-danger">declined</span>
                @endif    
              </td>
              <td><a href="{{route('user.voucher.view', $item->id)}}" class="btn btn-sm btn-primary" >View</a></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
</div>
@endsection