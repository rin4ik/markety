 
<nav aria-label="breadcrumb">
    <div class="container">
        
    <ul class="breadcrumb"> 

        @if (Route::is('catalog.show')) 
          @if(!empty($catalog->parent_id))
               @include('layouts.partials.each' ,['parent' => $catalog->parent])
          @endif 
            <li>{{ $catalog->name }}</li>
        @endif

        @if (Route::is('channels'))
            <li><span>&#10095;</span></li>
            <li  >{{ ucwords($channel->name) }}</li>
        @endif

        @if (request()->has('popular'))
            <li><span style="color:#ef5753">&#10095;</span></li>
            <li class="text-grey-darkest">Popular</li>
        @endif
        @if (request()->has('by'))
        <li><span class="mx-2 text-red-light">&#10095;</span></li>
        <li class="text-grey-darkest">My Threads</li>
    @endif

        @if (request()->has('unanswered'))
            <li><span class="mx-2 text-red-light">&#10095;</span></li>
            <li class="text-grey-darkest">Unanswered</li>
        @endif

        @if (Route::is('threads.show'))
            <li><span class="mx-2 text-red-light">&#10095;</span></li>
            <li class="breadcrumb-item">
                <a href="{{ route('channels', $thread->channel) }}" class="text-black">
                    {{ ucwords($thread->channel->name) }}
                </a>
            </li>

            <li><span class="mx-2 text-red-light">&#10095;</span></li>
            <li class="text-grey-darkest">{{ $thread->title }}</li>
        @endif
          </ul>
    </div>
</nav>
