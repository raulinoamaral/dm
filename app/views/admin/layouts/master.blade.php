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
</head>
<body>
    @yield('content')
    
    @section('script')
        {{ HTML::script('js/jquery-1.11.1.min.js') }}
        {{ HTML::script('js/angular.js') }}
        {{ HTML::script('js/bootstrap.min.js') }}
        {{ HTML::script('js/ui-bootstrap-tpls-0.10.0.js') }}
        {{ HTML::script('js/jquery-ui.min.js') }}
        {{ HTML::script('js/jquery.ui.touch-punch.min.js') }}
        {{ HTML::script('js/angular-animate.js') }}
        {{ HTML::script('js/angular-route.js') }}
        {{ HTML::script('js/angular-resource.js') }}
        {{ HTML::script('js/jquery.fileupload-angular.js') }}
        {{ HTML::script('js/app.js') }}
        {{ HTML::script('js/services.js') }}
        {{ HTML::script('js/controllers.js') }}
        {{ HTML::script('js/panel.js') }}
    @show
</body>
</html>