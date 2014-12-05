@extends('layouts.master')
@section('css')
@parent
@stop
@section('script')
@parent
@stop

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<div class="border-top">
					<h2><a href="{{ asset('portafolio/viviendas-familiares') }}" title="Ver proyectos de viviendas familiares">Viviendas familiares</a></h2>
					<a href="{{ asset('portafolio/viviendas-familiares') }}" title="Ver proyectos de viviendas familiares">
						<img src="{{ asset('img/arquitectura-vivienda-familiar.jpg') }}" class="img-responsive img-inicio">
					</a>
				</div>
				<div class="border-top">
					<h2><a href="{{ asset('portafolio/reforma-de-viviendas') }}" title="Ver proyectos de reforma de viviendas">Reforma de viviendas</a></h2>
					<a href="{{ asset('portafolio/reforma-de-viviendas') }}" title="Ver proyectos de reforma de viviendas">
						<img src="{{ asset('img/arquitectura-reforma-viviendas.jpg') }}" class="img-responsive img-inicio">
					</a>
				</div>
			</div>
			<div class="col-sm-8">
				<div class="border-top">
					<h2><a href="{{ asset('portafolio/complejos') }}" title="Ver proyectos de complejos">Complejos</a></h2>
					<a href="{{ asset('portafolio/complejos') }}" title="Ver proyectos de complejos">
						<img src="{{ asset('img/las-eduardas-render.jpg') }}" class="img-responsive img-inicio">
					</a>	
				</div>					
			</div>
		</div>
	</div>
@stop