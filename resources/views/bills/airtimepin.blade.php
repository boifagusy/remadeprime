@extends('user.layouts.master')
@section('title', 'Print Cards')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex align-items-center justify-content-between">
            <h5 class="fw-bold">Print Voucher</h5>
        <a href="{{route('user.vouchers.logs')}}" class="btn btn-primary btn-sm">History</a>
        </div>
    </div>
  <div class="card-body">
      <form action="{{route('bills.cardpin')}}" method="post">
        @csrf
          <div class="form-group">
              <label for="" class="form-label">Select Network<span class="text-danger">*</span></label>
              <select name="network" id="" class="form-select" required>
                <option > Select Network</option>
                @foreach ($networks as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
              </select>
          </div>
          <div class="form-group">
            <label for="" class="form-label">Select Value<span class="text-danger">*</span></label>
            <select name="value" id="priceRange" class="form-select" required onchange="getPrice()">
                <option >Select recharge value</option>
                <option value="100" price="100">100</option>
                <option value="200" price="200">200</option>
                <option value="500" price="500">500</option>
                <option value="1000" price="1000">1000</option>
            </select>
        </div>
          <div class="form-group">
              <label for="" class="form-label">Quantity <span class="text-danger">*</span></label>
              <input type="number" id="quantity" onkeyup="getPrice2()" value="1" class="form-control" name="quantity" required placeholder="Pin Quantity">
          </div>
          <div class="form-group">
              <label for="" class="form-label">Amount <span class="text-danger">*</span></label>
              <input type="number" class="form-control" readonly id="tAmount" name="amount" required placeholder="Purchase Amount">
          </div>
          <div class="form-group">
              <button type="submit" class="btn btn-primary btn-s">Generate PINs</button>
          </div>
      </form>
  </div>
</div>
@endsection

@section('scripts')
<script>
    function getPrice() {
        var select = document.getElementById('priceRange');
        var option = select.options[select.selectedIndex];
        var dprice = option.getAttribute("price");
        var quantity =  document.getElementById('quantity').value;
        var totalPrice = dprice * quantity
        document.getElementById('tAmount').value = totalPrice;
    }
    getPrice()
    function getPrice2() {
        var select = document.getElementById('priceRange');
        var option = select.options[select.selectedIndex];
        var dprice = option.getAttribute("price");
        var quantity =  document.getElementById('quantity').value;
        var totalPrice = dprice * quantity
        document.getElementById('tAmount').value = totalPrice;
    }
    getPrice2()
</script>
@endsection