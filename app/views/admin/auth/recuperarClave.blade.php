@extends('admin/layouts.master')
@section('content')
<section class="container">
    <div id="wrapper-login">
        <div id="logo-login">
            <a href="/" title="Ir a bgarquitectos.com.uy" target="_blank"><img src="{{ asset('img/benech-gerez-arquitectos.png') }}" alt="Benech Gerez Arquitectos &amp; Asociados" /></a>
        </div>
        {{ Form::open( array('id'=>'formRecuperarClave', 'class'=>'formulario', 'method' => 'POST', 'url' => 'admin/enviar-clave', 'onSubmit' => 'return validarRecuperarClave()')) }}
            {{ Form::label('E-mail') }}
            {{ Form::text('email') }}
            <div id="error" class="alert alert-danger hidden">
                Este e-mail no es correcto.
            </div>
            <div id="success" class="alert alert-success hidden">
                Hemos enviado un enlace a su e-mail.
            </div>
            {{ Form::submit('RECUPERAR CLAVE', array('id'=>'botonRecuperar', 'class' => 'btn btn-success')) }}
        {{ Form::close() }}
        <span>Sistema desarrollado por <a href="http://balloon.com.uy" title="Ir a balloon.com.uy" target="_blank"> balloon</a></span>
    </div>
</section>
@stop