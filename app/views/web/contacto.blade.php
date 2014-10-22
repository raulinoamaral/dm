@extends('layouts.master')
@section('body')
	onLoad="initialize()"
@stop
@section('css')
@parent
@stop
@section('script')
	{{ HTML::script('http://maps.google.com/maps/api/js?sensor=false') }}
	{{ HTML::script(asset('js/googleMaps.js')) }}
@parent
@stop

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<div class="border-top">
					<h1>Contacto</h1>
					<p>Por consultas complete el siguiente formulario y a la brevedad nos pondremos en contacto con usted. Tambi&eacute;n puede escribirnos a <a href="mailto:info@decarlinimaside.com" title="Enviar e-mail">info@decarlinimaside.com</a></p>
					{{ Form::open(['id' => 'formContacto']) }}
					{{ Form::input('text', 'nombre', '', ['id' => 'nombre', 'placeholder' => 'Nombre']) }}
					{{ Form::input('text', 'mail', '', ['id' => 'mail', 'placeholder' => 'E-mail']) }}
					{{ Form::textarea('mensaje', '', ['id' => 'mensaje', 'placeholder' => 'Mensaje']) }}
					{{ Form::submit('Enviar', ['id' => 'btnEnviar']) }}
					{{ Form::close() }}
				</div>
				
			</div>
			<div class="col-sm-8">
				<div class="border-top">
					<h2>Av. del Navio s/n “Rinc&oacute;n de Piedra” / La Paloma / Uruguay</h2>
					<div id="mapa"></div>	
				</div>					
			</div>
		</div>
	</div>
@stop