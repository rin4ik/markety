@extends('admin.layouts.app')
@section('content') 
<div class="page-body">
  <products :filters="{{$filters}}" :manufacturers="{{$manufacturers}}" :categories="{{$categories}}" :products="{{$products}}"></products> 
</div>
@endsection