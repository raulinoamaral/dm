<!doctype html>
<html lang="es_UY">
<head>
	<meta charset="UTF-8">
    <title>{{ $title }}</title>
    <meta name="description" content="{{ $meta_description }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

     @section('css')
        {{ HTML::style('css/bootstrap.min.css') }}
        {{ HTML::style('css/estilo.css') }}
    @show
    @section('script')
        {{ HTML::script('js/jquery-1.11.1.min.js') }}
        {{ HTML::script('js/bootstrap.min.js') }}
    @show
</head>
<body>
	@include('layouts.nav')
    @yield('content')
</body>
</html>