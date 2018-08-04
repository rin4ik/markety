@extends('admin.layouts.app')
@section('content') 
<div class="page-body">
  <catalogs :categories="{{$categories}}" :allcats="{{$all}}" :catalogs="{{$catalogs}}"></catalogs> 
</div>
@endsection