@extends('layouts.app')
@section('content')
@include('layouts.partials.breadcrumb')  

        <h2 style="margin-bottom:10px">{{$catalog->name}}</h2>    
 
        <p style="margin-left:20px"> 
        @foreach($catalog->children as $catalog)
            @if(count($catalog->children) <=0)
               <a href="/catalogs/{{$catalog['id']}}">{{$catalog['name']}}</a>
            @else
            {{$catalog['name']}}            
                @foreach($catalog->children as $child)
                    <p style="margin-left:30px">
                        <a href="/catalogs/{{$child['id']}}">{{$child['name']}}</a>   
                    </p> 
                @endforeach
            @endif
        @endforeach
         </p> 
     
@endsection