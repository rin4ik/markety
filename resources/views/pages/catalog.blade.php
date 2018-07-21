@extends('layouts.app')
@section('content')
<section class="section"><div class="container"><h1 class="title font-wb">Мобильные телефоны</h1></div></section>
<div class="container">
  <div class="row">
    <aside class="col side-left">
      @include('layouts.partials.filter')
    </aside>
    <main class="col c-md-9 main" role="main">
      @include('layouts.partials.sorter')
      @include('layouts.partials.products')
    </main>
  </div>
</div>
@endsection