@extends('layouts.app')

@section('content')  

<div class="container">
    <div class="row">
      <aside class="col side-left"> 
            <ul class="nav">
              @forelse($catalogs as $catalog)
                <li class="item"><a class="link" href="catalogs/{{$catalog->id}}"><span>{{$catalog->name}}</span></a></li>
              @empty
                  Нет Категорий
              @endforelse
            </ul> 
      </aside>
      <main class="col main" role="main">
        @include('layouts.partials.products')
      </main>
    </div>
  </div> 
@endsection