@extends('layouts.app')
@section('content') 
@include('layouts.partials.breadcrumb')  
<section class="section"><div class="container"><h1 class="title font-wb"> {{$catalog->fullName}}</h1></div></section> 
<div class="container">  
    <product-filters :catalog="{{$catalog}}" :products="{{collect($products)}}" :filters="{{$filters}}"></product-filters>    
</div>  
@endsection