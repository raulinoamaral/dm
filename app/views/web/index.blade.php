@extends('layouts.master')
@section('css')
@parent
	{{ HTML::style(asset('css/owl.carousel.css')) }}
	{{ HTML::style(asset('css/owl.theme.css')) }}
@stop
@section('script')
@parent
	{{ HTML::script(asset('js/owl.carousel.min.js')) }}
	<script>
		$(document).ready(function() {
 			$("#owl-demo").owlCarousel({
				navigation : false, // Show next and prev buttons
				slideSpeed : 900,
				paginationSpeed : 1000,
				singleItem:true,
				autoPlay: true
	  		});
		});
		$(window).scroll(function (){
			if(navigator.platform != "iPad")
			{
				if($(window).width() > 960)
				{
		   			if ($(window).scrollTop() < 444)
						$('header').removeClass("borde");
					else
						$('header').addClass("borde");
				}
			}		
		});

	</script>
@stop

@section('content')
	<div id="owl-demo" class="owl-carousel owl-theme">
		<div class="item"><img src="{{ asset('img/proyecto-casa-1.jpg') }}"></div>
		<div class="item"><img src="{{ asset('img/proyecto-casa-2.jpg') }}"></div>
		<div class="item"><img src="{{ asset('img/proyecto-casa-3.jpg') }}"></div>
	</div>
	<section id="page">
		<div class="container">
			<h1>Arquitectura y Dise&ntilde;o</h1>
			<div class="row">
				<div class="col-sm-4 programa">
					<img src="{{ asset('img/proyecto-casa.jpg') }}" class="img-responsive">
					<h2>Complejos</h2>
				</div>
				<div class="col-sm-4 programa">
					<img src="{{ asset('img/proyecto-casa-2.jpg') }}" class="img-responsive">
					<h2>Casas</h2>
				</div>
				<div class="col-sm-4 programa">
					<img src="{{ asset('img/proyecto-casa-3.jpg') }}" class="img-responsive">
					<h2>Reformas</h2>
				</div>
			</div>
		</div>
	</section>
@stop