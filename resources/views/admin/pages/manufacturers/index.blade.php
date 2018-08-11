@extends('admin.layouts.app')
@section('content')
    <manufacturers :categories="{{$categories}}" :manufacturers="{{$manufacturers}}"></manufacturers>
@endsection