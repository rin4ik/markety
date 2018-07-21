@extends('layouts.app')
@section('content')
<section class="section">
  <div class="container">
    <h1 class="title">Samsung</h1>ratting
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="row">
      <aside class="col side-left">
        <div class="panel">
          <div class="panel-body">
            <img src="/img/samsunglogo.jpg" width="100%" height="100%;">
          </div>
        </div>
        
          9 лет на Яндекс.Маркете
        
      </aside>
      <main class="col main">
                <div class="panel">
          <ul class="nav nav-tabs product-tab-nav" id="myTab" role="tablist">
            <li class="item" ><a class="link active" data-toggle="tab" href="#offers" role="tab" >Товари</a>
            </li><li class="item"><a class="link" data-toggle="tab" href="#geo">О бренде</a>
            </li><li class="item"><a class="link" data-toggle="tab" href="#geo">Отзывы</a>
            </li><li class="item"><a class="link" data-toggle="tab" href="#reviews">test</a></li>
          </ul>
        </div>

        @include('layouts.partials.products')
      </main>
    </div>
  </div>
</section>
@endsection