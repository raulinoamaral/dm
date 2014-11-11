@extends('admin/layouts.master')
@section('content')
<section class="container">
    <div id="wrapper-login">
        <div id="logo-login">
            <a href="/" title="Ir a decarlinimaside.com.uy" target="_blank"><img src="{{ asset('img/decarlini-maside-arquitectos.png') }}" alt="Decarlini Maside" class="img-responsive" /></a>
        </div>
        {{ Form::open( array('id'=>'formLogin', 'class'=>'formulario', 'method' => 'POST', 'url' => 'autenticar')) }}
            {{ Form::label('Usuario') }}
            {{ Form::text('username', Input::old('username'), array('id' => 'username')) }}
            {{ Form::label('Clave') }}
            {{ Form::password('password', '', array('id' => 'password')) }}
            <a href="{{ asset('admin/recuperar-clave') }}" title="&iquest;Olvid&oacute; su clave?" class="olvido-clave">&iquest;Olvid&oacute; su clave?</a>
            {{ Form::submit('Iniciar sesi&oacute;n', array('id'=>'botonIngresar', 'class' => 'btn btn-success')) }}
        {{ Form::close() }}
        <span>Sistema desarrollado por <a href="http://balloon.com.uy" title="Ir a balloon.com.uy" target="_blank"> balloon</a></span>
    </div>
</section>
@stop