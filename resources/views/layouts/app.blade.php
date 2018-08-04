<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
@include('layouts.partials.head')
<body> 
  
    <div class="app" id="app">
        @include('layouts.partials.header')
        
        
        <div v-cloak>
            @include('modal.all')   
        </div> 

        <main>
            @yield('content')
        </main> 
        @include('layouts.partials.footer')
        
    </div>

    <!-- Scripts -->
    @include('layouts.partials.scripts')
</body>
</html>
