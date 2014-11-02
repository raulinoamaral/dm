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
					<h2>Viviendas familiares</h2>
					<img src="{{ asset('img/arquitectura-vivienda-familiar.jpg') }}" class="img-responsive img-inicio">
				</div>
				<div class="border-top">
					<h2>Reformas de vivienda</h2>
					<img src="{{ asset('img/arquitectura-reforma-viviendas.jpg') }}" class="img-responsive img-inicio">
				</div>
			</div>
			<div class="col-sm-8">
				<div class="border-top">
					<h2>Complejos</h2>
					<img src="{{ asset('img/las-eduardas-render.jpg') }}" class="img-responsive img-inicio">	
				</div>					
			</div>
		</div>
	</div>
@stop