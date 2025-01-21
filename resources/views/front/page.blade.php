@extends('front.layouts.master')
@section('title', $page->title)
@section('content')
<div class="card">
    <div class="card-body">
        {!! $page->content !!}
    </div>
</div>
@endsection