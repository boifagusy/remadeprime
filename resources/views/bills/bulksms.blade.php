@extends('user.layouts.master')
@section('title', 'Send Bulk SMS')

@section('content')
<div class="card">
  <div class="card-body">
      <h5 class="fw-bold mb-3">Bulk SMS</h5>
      <form action="{{route('bills.bulksms')}}" method="post">
        @csrf
          <div class="form-group">
              <label for="" class="form-label">Sender Name<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="sender" required placeholder="Sender name">
          </div>
          <div class="form-group">
              <label for="" class="form-label">Recipient Numbers <small>(separated by comma ",")</small> <span class="text-danger">*</span></label>
              <textarea class="form-control" rows="2" name="recipient" required placeholder="Recepients Number"></textarea>
          </div>
          <div class="form-group">
            <label for="" class="form-label">Message <span class="text-danger">*</span></label>
            <textarea class="form-control" rows="3" name="message" required placeholder="Message Content"></textarea>
          </div>
          
          <div class="form-group">
              <button type="submit" class="btn btn-primary btn-s">Send SMS</button>
          </div>
      </form>
  </div>
</div>
@endsection