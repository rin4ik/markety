@extends('layouts.app')
@section('content')
<section class="section">
  <div class="container">
    <h1 class="title f-product-title">Смартфон Samsung Galaxy S9 64GB</h1><div class="rating">4.5</div>
  </div>
</section>
<section class="section">
  <div class="container">
    <div class="row">
      <aside class="col side-left">
        <div class="panel">
          <div class="panel-body">
            <div id="f-product-gallery" class="carousel gallery" data-ride="carousel">
              <div class="gallery-images carousel-inner">
                <div class="item carousel-item active"><img class="image" src="/img/1.jpg" alt=""></div>
                <div class="item carousel-item"><img class="image" src="/img/2.jpg" alt=""></div>
                <div class="item carousel-item"><img class="image" src="/img/3.jpg" alt=""></div>
                <div class="item carousel-item"><img class="image" src="/img/4.jpg" alt=""></div>
              </div>
              <ul class="gallery-thumbs carousel-indicators">
                <li class="active" data-target="#f-product-gallery" data-slide-to="0"><img src="/img/1.jpg" alt="">
                </li><li data-target="#f-product-gallery" data-slide-to="1"><img src="/img/2.jpg" alt="">
                </li><li data-target="#f-product-gallery" data-slide-to="2"><img src="/img/3.jpg" alt="">
                </li><li data-target="#f-product-gallery" data-slide-to="3"><img src="/img/4.jpg" alt=""></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="brand"><a href="/brands">Все товары Samsung</a></div>
      </aside>
      <main class="col main">
        <div class="panel">
          <ul class="nav nav-tabs product-tab-nav" id="myTab" role="tablist">
            <li class="item" ><a class="link active" data-toggle="tab" href="#offers" role="tab" >Цены<span class="count">11</span></a>
            </li><li class="item d-none"><a class="link" data-toggle="tab" href="#spec">Характеристики</a>
            </li><li class="item"><a class="link" data-toggle="tab" href="#geo">Карта<span class="count">11</span></a>
            </li><li class="item"><a class="link" data-toggle="tab" href="#geo">Обзоры<span class="count">11</span></a>
            </li><li class="item"><a class="link" data-toggle="tab" href="#reviews">Отзывы<span class="count">11</span></a></li>
          </ul>
        </div>
        <div class="panel">
          <div class="panel-header">
              Сортировать:
            по цене
            <a href="#">по популярности</a>


          </div>
          <div class="tab-content" id="myTabContent">
            <div class="f-product-offers tab-pane show active" id="offers" role="tabpanel">
              <div class="f-product-offer-list">
                <div class="f-product-offer">
                  <div class="c f-product-offer-price">
                    <div class="f-product-offer-price-value">1 800 000 c.</div>
                  </div><div class="c f-product-offer-spec">
                    <div class="f-product-offer-spec-name">Цвет товара: голубой</div>
                  </div><div class="c f-product-offer-shop">
                    <a class="f-product-offer-shop-name" href="/shops">Olcha.uz</a>
                  </div><div class="c f-product-offer-buy">
                    <button class="btn btn-red">В корзину</button>
                  </div>
                </div>
              </div>
              <div class="panel-footer">
                <ul class="pagination">
                  <li class="page-item"><a class="page-link" href="#">Назад</a></li>
                  <li class="page-item active"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">Вперед</a></li>
                </ul>
              </div>
            </div>
            <div class="tab-pane" id="spec" role="tabpanel">
              <div class="f-product-spec-body">
                <h2 class="title">Общие характеристики</h2>
                <dl><dt><span>Тип</span></dt><dd><span>смартфон</span></dd></dl>
                <dl><dt><span>Версия ОС</span></dt><dd><span>Android 8.0</span></dd></dl>
                <dl><dt><span>Тип корпуса</span></dt><dd><span>классический</span></dd></dl>
                <dl><dt><span>Конструкция</span></dt><dd><span>водозащита</span></dd></dl>
              </div>
              <div class="f-product-spec-body">
                <h2 class="title">Экран</h2>
                <dl><dt><span>Тип экрана</span></dt><dd><span>цветной AMOLED, сенсорный</span></dd></dl>
                <dl><dt><span>Тип сенсорного экрана</span></dt><dd><span>мультитач, емкостный</span></dd></dl>
                <dl><dt><span>Диагональ</span></dt><dd><span>5.8 дюйм.</span></dd></dl>
                <dl><dt><span>Изогнутый экран</span></dt><dd><span>есть</span></dd></dl>
              </div>
            </div>
            <div class="tab-pane" id="reviews" role="tabpanel">reviews</div>
            <div class="tab-pane" id="geo" role="tabpanel">geo</div>
            <div class="tab-pane" id="articles" role="tabpanel">articles</div>
          </div>
        </div>
      </main>
    </div>
  </div>
</section>
@endsection