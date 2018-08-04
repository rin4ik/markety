@extends('layouts.app')
@section('content') 
@include('layouts.partials.breadcrumb')  

<h2>{{$catalog->category->name}}</h2>
<ul style="margin:20px"> 
   
    @foreach($filters as $filter)
    
    <li>
        <h4  style="margin-bottom:10px">{{$filter['name']}}</h4> 
        @if($filter['type'] == 'checkbox')
            @foreach($filter['options'] as $option)
                <p>
                    <input type="checkbox" name="{{$filter['name']}}[]" value="{{$option[0]}}"> {{$option[1]}}
                </p> 
            @endforeach
        @endif  
        @if($filter['type'] == 'radio')
            @foreach($filter['options'] as $option)
                <p>
                    <input type="radio" name="{{$filter['name']}}" value="{{$option[0]}}"> {{$option[1]}}
                </p> 
            @endforeach
        @endif
        @if($filter['type'] == 'input')
            @foreach($filter['options'] as $option)
                <p>
                    <input type="text" value="{{$option[0]}}"> {{$option[1]}}
                </p> 
            @endforeach
        @endif 
    </li>
    @endforeach

    @foreach($catalog->category->products as $product)
        <p>Продукт с id: {{$product->id}} </p>
        <p>Продукт принадлежить категорию с id : {{$catalog->category->name}} </p>
        <p>Продукт принадлежить производителю с id : {{$product->manufacturer->name}} </p>
    @endforeach
</ul>
{{--  <all-filters :catalog="{{$catalog}}" :filters="{{$filters}}"></all-filters>  --}}

@endsection