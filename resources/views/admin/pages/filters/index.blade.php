@extends('admin.layouts.app')
@section('content') 
<div class="page-body">
  @if(isset($filters))
  <filters :filters="{{$filters}}" :categories="{{$categories}}"></filters> 
  @else
  <filters :categories="{{$categories}}"></filters> 
  
  @endif
</div>
@endsection