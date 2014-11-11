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
						<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
							<a href="{{ asset('portafolio') }}" title="Todos los proyectos" itemprop="url">
								<span itemprop="title">Portafolio<span>
							</a>
						</li>
						<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
							<a href="{{ $proyecto->categoria->getLink() }}" title="Todos los proyectos de {{ $proyecto->categoria->nombre }}" itemprop="url">
								<span itemprop="title">{{ $proyecto->categoria->nombre }}</span>
							</a>
						</li>
						<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb" class="active">
							<span itemprop="title">{{ $proyecto->titulo }}</span>
						</li>
					</ol>
					<article>
						<h1>{{ $proyecto->titulo }}</h1>
						<p>{{ nl2br($proyecto->descripcion) }}</p>
						<table class="table">
							@if($proyecto->ubicacion != '')
							<tr>
								<td>Ubicaci&oacute;n</td>
								<td>{{ $proyecto->ubicacion }}</td>
							</tr>
							@endif
							@if($proyecto->superficie != '')
							<tr>
								<td>Superficie</td>
								<td>{{ $proyecto->superficie }} m&sup2;</td>
							</tr>
							@endif
							@if($proyecto->ano != '')
							<tr>
								<td>A&ntilde;o</td>
								<td>2012</td>
							</tr>
							@endif
						</table>
					</article>
				</div>
			</div>
			@if(!$proyecto->imagenes->isEmpty())
			<div class="col-sm-8">
				<section id="galeria" class="border-top">
					<a href="{{ $proyecto->fotoPortada()->getBigSrc() }}"><img src="{{ $proyecto->fotoPortada()->getPdaSrc() }}" class="img-responsive img-destacada"></a>
					@foreach($proyecto->imagenesRestantes() as $imagen)
					<a href="{{ $imagen->getBigSrc() }}"><img src="{{ $imagen->getMinSrc() }}" class="img-responsive"></a>
					@endforeach
				</section>
			</div>
			@endif

		</div>
	</div>
@stop