@extends('layouts.app')
@section('content')
@include('layouts.partials.breadcrumb')  
  
        <section class="section"><div class="container"><h1 class="title font-wb"> {{$catalog->fullName}}</h1></div></section> 
        <div class="container">
                <div class="row">            
                    <aside class="col side-left"> 
            <div class="catalog-nav">
                    
        @foreach($catalog->children as $catalog)
            
          
                
                    <div class="catalog-nav-group">
                            @if(count($catalog->children) <=0) 
                            <a class="catalog-nav-title" href="/catalog/{{$catalog['id']}}">{{$catalog['name']}}</a> 
                         @else       
                        <a class="catalog-nav-title" href="/catalog/{{$catalog->id}}">{{$catalog['name']}}</a>   
                      <div class="catalog-nav-links">
                            
            @foreach($catalog->children as $child)
            
                            <a  href="/catalog/{{$child['id']}}">{{$child['name']}}</a>  
                @endforeach
                      </div>
                      
                    </div>
                
            @endif
        @endforeach
    </div> 
    
                </aside> 
 </div>
 </div>    
@endsection