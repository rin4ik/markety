<header class="header">
  <div class="container">
    <div class="row">
      <div class="header-main-left col">
        <a class="header-logo" href="/"><img src="/img/logo.png"></a>
        <button class="btn header-category-toggle" type="button"><i class="icon">menu</i><span class="text">Каталог товаров</span>
        </button>
      </div>
      
      <div class="header-main-right col">
        <div class="row">
          <div class="col-7">
          <form class="input-group header-search" method="get" action="/search">
            <input class="form-control" name="text" type="search" placeholder="Поиск товаров">
            <div class="input-group-btn"><button class="btn" type="submit">Найти</button></div>
          </form>
          </div>
          <div class="col-5">
            <ul class="header-user-box nav">
              <li class="item header-profile">
                <button class="btn btn-link" type="button" data-toggle="modal" data-target="#login"><i class="icon">account_circle</i><span class="text">Мой профиль</span></button>
              </li><li class="item header-cart">
              <a class="btn btn-link" href="/cart"><span class="badge badge-red">1</span><i class="icon">shopping_cart</i><span class="text">Корзина</span></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
<? include_once ROOT_DIR.'/template/block/categories.php' ?>
</header> 