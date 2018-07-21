@extends('admin.layouts.app')
@section('content') 
<div class="page-body">
  <categories :all="{{$allCategories}}" :categories="{{$categories}}"></categories> 
</div>
@endsection