@extends('admin/layouts.master')
@section('content')
<section class="container">
    <div id="wrapper-login">
        <div id="logo-login">
            <a href="/" title="Ir a bgarquitectos.com.uy" target="_blank"><img src="{{ asset('img/benech-gerez-arquitectos.png') }}" alt="Benech Gerez Arquitectos &amp; Asociados" /></a>
        </div>
        {{ Form::open( array('id'=>'formNuevaClave', 'class'=>'formulario', 'method' => 'POST', 'url' => 'admin/guardar-clave', 'onSubmit' => 'return validarNuevaClave()')) }}
            <input type="hidden" name="token" value="{{ $token }}">
            <div id="removible">
                {{ Form::label('E-mail') }}
                {{ Form::text('email', '' , array('id' => 'email', 'autocomplete' => 'off',)) }}
                <div id="emailError" class="alert alert-danger hidden">
                    Verifique su e-mail.
                </div>
                {{ Form::label('Nueva clave') }}
                {{ Form::password('password', array('id' => 'password', 'autocomplete' => 'off')) }}
                {{ Form::label('Confirmar nueva clave') }}
                {{ Form::password('password_confirmation', array('id' => 'password_confirmation', 'autocomplete' => 'off')) }}
                <div id="passwordError" class="alert alert-danger hidden">
                    Verifique la clave y su confirmaci&oacute;n.
                </div>
                {{ Form::submit('GUARDAR', array('id'=>'botonGuardar', 'class' => 'btn btn-success')) }}
            </div>
            <div id="success" class="hidden">
                Clave renovada. Ahora puede <a href="{{ asset('admin/login') }}">iniciar sesi&oacute;n</a> con su nueva contrase&ntilde;a.
            </div>
        {{ Form::close() }}
        <span>Sistema desarrollado por <a href="http://balloon.com.uy" title="Ir a balloon.com.uy" target="_blank"> balloon</a></span>
    </div>
</section>
@stop