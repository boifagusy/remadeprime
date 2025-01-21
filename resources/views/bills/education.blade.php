@extends('user.layouts.master')
@section('title', 'Education Payment')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex align-items-center justify-content-between">
        <h5 class="fw-bold ">Education Services</h5>
        <a href="{{route('user.education.logs')}}" class="btn btn-primary btn-sm">History</a>
        </div>
    </div>
  <div class="card-body">
      <form action="{{route('bills.education')}}" method="post">
        @csrf
          <div class="form-group">
              <label for="" class="form-label">Select Service <span class="text-danger">*</span></label>
              <select name="service" id="examType" onchange="getPrice()" class="form-select" required>
                  <option > Select Education Service</option>
                  @foreach ($education as $item)
                    <option value="{{$item->id}}" price={{$item->price}}>{{$item->name}}</option>
                  @endforeach
              </select>
          </div>
          <div class="form-group">
              <label for="" class="form-label">Quantity <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="quantity" onkeyup="getPrice2()" name="quantity" value="1" required placeholder="PIN Quantity">
          </div>
          <div class="form-group">
              <label for="" class="form-label">Amount <span class="text-danger">*</span></label>
              <input type="text" class="form-control" readonly id="tAmount" name="amount" required placeholder="Purchase Amount">
          </div>
          <div class="form-group">
              <button type="submit" class="btn btn-primary btn-s">Confirm Purchase</button>
          </div>
      </form>
  </div>
</div>
@endsection
@section('scripts')
<script>
    function getPrice() {
        var select = document.getElementById('examType');
        var option = select.options[select.selectedIndex];
        var dprice = option.getAttribute("price");
        var quantity =  document.getElementById('quantity').value;
        var totalPrice = dprice * quantity
        document.getElementById('tAmount').value = totalPrice;
    }
    getPrice()
    function getPrice2() {
        var select = document.getElementById('examType');
        var option = select.options[select.selectedIndex];
        var dprice = option.getAttribute("price");
        var quantity =  document.getElementById('quantity').value;
        var totalPrice = dprice * quantity
        document.getElementById('tAmount').value = totalPrice;
    }
    getPrice2()
</script>
@endsection