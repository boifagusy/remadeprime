@extends('user.layouts.master')
@section('title', 'Airtime 2 Cash')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex align-items-center justify-content-between">
        <h5 class="fw-bold ">Airtime Swap</h5>
        <a href="{{route('user.swap.logs')}}" class="btn btn-primary btn-sm">History</a>
        </div>
    </div>
  <div class="card-body">
      <form action="{{route('bills.airtime_swap')}}" method="post">
        @csrf
          <div class="form-group">
              <label for="" class="form-label">Network<span class="text-danger">*</span></label>
              <select name="network" id="networkSel" onchange="calculateRate()" class="form-select" required>
                  <option > Select Network</option>
                  @foreach ($networks as $item)
                  <option value="{{$item->id}}" rate="{{$item->rate}}" trxnumber="{{$item->number}}">{{$item->name}}</option>
                  @endforeach
              </select>
          </div>
          <div class="form-group">
                <label for="" class="form-label">Phone Number <span class="text-danger">*</span></label>
                <input type="text" class="form-control" maxlength="11" name="phone" required placeholder="08035852702">
          </div>
          <div class="form-group">
                <label for="" class="form-label">You Send<span class="text-danger">*</span></label>
                <input type="number" id="pAmount" onkeyup="calculatePrice()" class="form-control" min="1000" name="amount" required placeholder="Enter Transfer Amount">
          </div>          
          <div class="form-group">
                <label for="" class="form-label">You Get <span class="text-danger">*</span></label>
                <div class="input-group mb-3">
                    <span class="input-group-text">Rate</span>
                    <input class="form-control" id="swap-rate" name="rate" readonly type="number"  placeholder="Swap Rate">
                    <span class="input-group-text">%</span>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">You Receive</span>
                    <input class="form-control" id="finalAmount" readonly type="number" placeholder="Final Amount">
                </div>
            </div>
            
            <div class="form-group">
                <label for="" class="form-label fw-bold">Transfer Money To</span></label>
                <input type="text" id="trxnumber" disabled placeholder="Select network" class="form-control form-control-lg" >
            </div>  
          <div class="form-group">
              <button type="submit" class="btn btn-primary btn-s">Swap Airtime</button>
          </div>
      </form>
  </div>
</div>
@endsection
@section('scripts')
<script>
function calculateRate(){
    var select = document.getElementById('networkSel');
    var option = select.options[select.selectedIndex];
    var trnumber = option.getAttribute("trxnumber");
    var rate = option.getAttribute("rate");
    var price =  document.getElementById('pAmount').value;
    var charge =  price * (rate/100)
    var finalPrice = price - charge
    document.getElementById('finalAmount').value = finalPrice;
    document.getElementById('swap-rate').value = rate;
    document.getElementById('trxnumber').value = trnumber;
}
calculateRate();
function calculatePrice(){
    var select = document.getElementById('networkSel');
    var option = select.options[select.selectedIndex];
    var rate = option.getAttribute("rate");
    var price =  document.getElementById('pAmount').value;
    var charge =  price * (rate/100)
    var finalPrice = price - charge
    document.getElementById('finalAmount').value = finalPrice;
    document.getElementById('swap-rate').value = rate;
}
calculatePrice()
</script>
@endsection