@if(!empty($parent->parent_id))
    @include('layouts.partials.each' ,['parent' => $parent->parent])
@endif
<li class="breadcrumb-item">
    <a href="/catalogs/{{$parent->id}}">{{$parent->name}}</a>
</li>
