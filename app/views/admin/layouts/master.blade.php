<!doctype html>
<html lang="es" ng-app="DMApp">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href='http://fonts.googleapis.com/css?family=Signika:400,700' rel='stylesheet' type='text/css'>
    @section('css')
        {{ HTML::style('css/bootstrap.css') }}
        {{ HTML::style('css/estilo-admin.css') }}
    @show

    @section('script')
        {{ HTML::script('js/jquery-1.11.1.min.js') }}
        {{ HTML::script('js/angular.min.js') }}
        {{ HTML::script('js/angular-route.min.js') }}
        {{ HTML::script('js/bootstrap.min.js') }}
        {{ HTML::script('js/app.js') }}
        {{ HTML::script('js/panel.js') }}
    @show
</head>
<body>
    @yield('content')
    @if(Request::path() != 'admin/login' && Request::path() != 'admin/recuperar-clave' && !Request::is('password*'))
        @include('admin/layouts.footer')
    @endif
</body>
</html>