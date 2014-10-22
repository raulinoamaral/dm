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
						<li class="filter" data-filter="all">Todos</li>
						<li class="filter" data-filter=".complejo" >Complejos</li>
						<li class="filter" data-filter=".residencia-familiar">Residencias familiar</li>
						<li>Reformas de viviendas</li>
					</ul>
				</div>
			</div>
			<div class="col-sm-8">
				<section id="proyectos">
						<div class="mix residencia-familiar" data-myorder="">
								<div class="resultado-proyecto border-top">
									<h2>Residencia familiar</h2>
									<img src="{{ asset('img/las-eduardas-render.jpg') }}" class="img-responsive">
									<p>Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor.</p>	
								</div>
						</div>
						<div class="mix complejo" data-myorder="">
							<div class="resultado-proyecto border-top">
								<h2>Complejo 1</h2>
								<img src="{{ asset('img/las-eduardas-render.jpg') }}" class="img-responsive">
								<p>Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor.</p>	
							</div>
						</div>
						<div class="mix complejo" data-myorder="">
							<div class="resultado-proyecto border-top">
								<h2>Complejo 2</h2>
								<img src="{{ asset('img/las-eduardas-render.jpg') }}" class="img-responsive">
								<p>Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor.</p>	
							</div>
						</div>
						<div class="mix complejo" data-myorder="">
							<div class="resultado-proyecto border-top">
								<h2>Complejo 3</h2>
								<img src="{{ asset('img/las-eduardas-render.jpg') }}" class="img-responsive">
								<p>Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor.</p>	
							</div>
						</div>
				</section>					
			</div>
		</div>
	</div>
@stop