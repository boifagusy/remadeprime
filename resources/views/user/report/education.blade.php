@extends('user.layouts.master')
@section('title', 'Education Payment')

@section('content')
<div class="card">
    <div class="card-body table-responsive">
      <table class="table w-100" id="dataTable2">
        <thead>
          <tr>           
            <th>Name</th> 
            <th>Quantuty</th>
            <th>Amount</th>
            <th>TRX Code</th>
            <th>Date</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($trx as $key => $item)
            <tr>
              <td>{{($item->education->name)}} </td>
              <td>{{$item->quantity ?? "1"}}</td>
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
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
</div>
@endsection