@extends('layouts.master')
@section('css')
@parent
@stop
@section('script')
@parent
	<script src="http://cdn.jsdelivr.net/jquery.mixitup/latest/jquery.mixitup.min.js"></script>
	<script src="js/funciones.js"></script>
@stop

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<div class="border-top">
					<h1>Portafolio</h1>
					<p>Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor.</p>
					<ul id="filtro-proyectos">
						<li>Todos</li>
						@foreach($categorias as $categoria)
						<li><a href="{{ $categoria->getLink() }}">{{ $categoria->nombre }}</a></li>
						@endforeach
					</ul>
				</div>
			</div>
			<div class="col-sm-8">
				<section id="proyectos">
					@foreach($proyectos as $proyecto)
						<div>
							<div class="resultado-proyecto">
								<h2 class="border-top"><a href="{{ $proyecto->getLink() }}" title="{{ $proyecto->titulo }}">{{ $proyecto->titulo }}</a></h2>
								<a href="{{ $proyecto->getLink() }}" title="{{ $proyecto->titulo }}"><img src="{{ $proyecto->getFotoResultadoSrc() }}" class="img-responsive"></a>
								<p>{{ $proyecto->descripcion_corta }}</p>	
							</div>
						</div>
					@endforeach
				</section>
				<div class="clear"></div>
				{{ $proyectos->links() }}				
			</div>
		</div>
	</div>
@stop