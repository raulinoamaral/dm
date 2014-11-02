@extends('layouts.master')
@section('css')
	{{ HTML::style(asset('css/magnific-popup.css')) }}
@parent
@stop
@section('script')
@parent
	{{ HTML::script(asset('js/jquery.magnific-popup.min.js')) }}
	<script>
	$(document).ready(function() {
		$('#galeria').magnificPopup({
			delegate: 'a',
			type: 'image',
			closeOnContentClick: false,
			closeBtnInside: false,
			mainClass: 'mfp-with-zoom mfp-img-mobile',
			image: {
				verticalFit: true,
			},
			gallery: {
				enabled: true
			},
			zoom: {
				enabled: true,
				duration: 300, // don't foget to change the duration also in CSS
				opener: function(element) {
					return element.find('img');
				}
			}
			
		});
	});
	</script>
@stop

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<div class="border-top">
					<ol class="breadcrumb">
						<li><a href="#" title="">Portafolio</a></li>
						<li><a href="#" title="">Tipo</a></li>
						<li class="active">Nombre proyecto</li>
					</ol>
					<article>
						<h1>Nombre proyectos</h1>
						<p>Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor.</p>
						<table class="table">
							<tr>
								<td>Ubicaci&oacute;n</td>
								<td>La Paloma</td>
							</tr>
							<tr>
								<td>Superficie</td>
								<td>129 m&sup2;</td>
							</tr>
							<tr>
								<td>A&ntilde;o</td>
								<td>2012</td>
							</tr>
						</table>
					</article>
				</div>
			</div>
			<div class="col-sm-8">
				<section id="galeria" class="border-top">
					<a href="{{ asset('img/proyecto-casa-3.jpg') }}"><img src="{{ asset('img/proyecto-casa-3.jpg') }}" class="img-responsive img-destacada"></a>
					<a href="{{ asset('img/las-eduardas-render.jpg') }}"><img src="{{ asset('img/las-eduardas-render.jpg') }}" class="img-responsive"></a>
					<a href="{{ asset('img/las-eduardas-render.jpg') }}"><img src="{{ asset('img/las-eduardas-render.jpg') }}" class="img-responsive"></a>
					<a href="{{ asset('img/las-eduardas-render.jpg') }}"><img src="{{ asset('img/las-eduardas-render.jpg') }}" class="img-responsive"></a>
					<a href="{{ asset('img/las-eduardas-render.jpg') }}"><img src="{{ asset('img/las-eduardas-render.jpg') }}" class="img-responsive"></a>
				</section>
			</div>
		</div>
	</div>
@stop