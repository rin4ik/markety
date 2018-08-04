<template>
    <div class="container">
    <div class="row">
      <aside class="col side-left">
        <ul class="nav">
        @forelse($categories as $category)
            <li class="item"><a class="link" href="/catalog"><i class="icon">check_box_outline_blank</i><span>{{$category->name}}</span></a></li>
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
</template>

<script>
export default {
    props:['catego']
}
</script>
