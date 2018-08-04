@extends('admin.layouts.app')
@section('content') 
<div class="page-body">
   <categories :categories="{{$categories}}"></categories>
</div>
@endsection