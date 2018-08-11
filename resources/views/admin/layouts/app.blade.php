<!DOCTYPE HTML>
<html lang="ru">
@include('admin.layouts.partials.head')
<body>
<div id="app">
  <header class="navbar navbar-expand fixed-top navbar-dark bg-dark p-0">
    <a class="navbar-brand col-2 mr-0" href="/">{{ config('app.name') }} </a>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">User name</a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
          <a class="dropdown-item" href="#">Профиль</a>
          <a class="dropdown-item" href="#">Выйти</a>
        </div>
      </li>
    </ul>
  </header>
  <div class="container">
    <div class="row">
      <aside class="col-2 sidebar bg-dark">
        <div class="sidebar-inner"> 
            <h6 class="sidebar-header pt-3">Tовары</h6>
            <ul class="nav flex-column">
                <li class="nav-item"><a href="/admin/products" class="nav-link">Карточка товаров</a></li> 
                <li class="nav-item"><a href="/admin/catalogs" class="nav-link">Каталог</a></li> 
                <li class="nav-item"><a href="/admin/categories" class="nav-link">Категории</a></li> 
                <li class="nav-item"><a href="/admin/manufacturers" class="nav-link">Производители</a></li>
                <li class="nav-item"><a href="/admin/filters" class="nav-link">Фильтры</a></li> 
            </ul>
        </div>
      </aside>
      <main class="col-10 ml-auto p-0"> 
          @yield('content')
      </main> 
      <flash levels="{{session('level','success')}}" message="{{session('flash')}}"></flash>
    </div>
  </div>
</div>
</body>