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
					<h1>{{ $categoria->nombre }}</h1>
					<p>{{ $categoria->descripcion }}</p>
					<ul id="filtro-proyectos">
						<li><a title="Ver todos" href="{{ asset('portafolio') }}">Todos</a></li>
						@foreach($categorias as $cat)
						<li>{{ $categoria == $cat ? $cat->nombre : '<a href="'. $cat->getLink() .'">'. $cat->nombre .'</a>' }} </li>
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
			</div>
			{{ $proyectos->links() }}
		</div>
	</div>
@stop