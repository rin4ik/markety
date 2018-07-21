@extends('admin.layouts.app')
@section('content')
    <manufacturers :manufacturers="{{$manufacturers}}"></manufacturers>
@endsection