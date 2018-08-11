<head>
<link rel="icon" type="image/png" href="/img/logo.png">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Font Awesome -->

<title>{{ config('app.name', 'Markety') }}</title>

<!-- Styles -->
<link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('css/grid.css') }}" rel="stylesheet">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<link href="{{ asset('css/custom.css') }}" rel="stylesheet">

<script>
    window.App={!!json_encode(['csrfToken'=>csrf_token(),
    'url'=>config('app.url'),
    'user'=>Auth::user(),
    'signedIn'=>Auth::check()
    ])!!};
</script>
<style>
[v-cloak] {
    display: none;
}
</style>
</head>