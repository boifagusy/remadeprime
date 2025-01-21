@extends('user.layouts.master')
@section('title', 'Buy '.$network->name." Plan")

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="fw-bold mb-3">{{$network->name}} Data Bundles</h5>
        <form action="{{route('bills.data.buyplan')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="" class="form-label">Data PLan <span class="text-danger">*</span></label>
                <select name="plan" id="planPrice" class="form-select" required onchange="calculatePrice()">
                    <option > Select Plan</option>
                    @foreach ($plans as $plan)
                    <option value="{{$plan->id}}" price="{{$plan->price}}">{{$plan->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="" class="form-label">Phone Number <span class="text-danger">*</span></label>
                <input type="text" class="form-control" maxlength="11" name="phone" required placeholder="Enter your phone number">
            </div>
            <div class="form-group">
                <label for="" class="form-label">Amount <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="buyAmount" readonly name="amount" required placeholder="Purchase Amount">
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
    function calculatePrice(){
        var select = document.getElementById('planPrice');
        var option = select.options[select.selectedIndex];
        var dprice = option.getAttribute("price");
        document.getElementById('buyAmount').value = dprice;
    }
    calculatePrice()
</script>
@endsection