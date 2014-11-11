@extends('admin/layouts.master')
@section('script')
@parent
	{{ HTML::script('js/jquery-ui.min.js') }}
	{{ HTML::script('js/jquery.ui.widget.js') }}
	{{ HTML::script('js/load-image.all.min.js') }}
	{{ HTML::script('js/canvas-to-blob.min.js') }}
	{{ HTML::script('js/jquery.iframe-transport.js') }}
	{{ HTML::script('js/jquery.fileupload.js') }}
	{{ HTML::script('js/jquery.fileupload-process.js') }}
	{{ HTML::script('js/jquery.fileupload-image.js') }}
	{{ HTML::script('js/jquery.fileupload-validate.js') }}
	{{ HTML::script('js/jquery.ui.touch-punch.min.js') }}
@stop
@section('content')
@include('admin.layouts.header')
	<div id="notificacion"></div>
	<div class="container">
		<h1>Galer&iacute;a del proyecto "{{ $proyecto->titulo }}"</h1>
	
		{{ Form::open(array(
				'name'		=>	'form',	
				'id' 		=> 	'form',
				'files'		=> 	'true')) }}
			<div class="row">
				<div class="col-sm-3">
					<div class="fileContainer">
						Examinar im&aacute;genes <span class="glyphicon glyphicon-plus"></span>
						{{ Form::file('imagen[]', array(
										'id'		=> 	'fileupload',
										'multiple'	=>	'multiple',
										'accept'	=>	'image/gif, image/jpeg')) }}
					</div>
					<h2 id="porcentual"></h2>
				</div>
			</div>
			<div class="progress">
      			<div id="progreso" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
    		</div>
			<input type="hidden" id="numeroImagen" name="numeroImagen" value="0">
		{{ Form::close() }}
			<p id="imagen-ppal" class="{{ $proyecto->imagenes()->count() > 0 ? '' : 'hidden' }}">Imagen principal</p>
			<div id="galeria-ordenada">
				<ul id="contenedorImagenes" class="selector">
					@foreach($proyecto->imagenes()->orderBy('orden')->get() as $imagen)
							<li id="orden_{{ $imagen->id }}" onMouseOver="mostrarEliminar({{ $imagen->id }})" onMouseOut="mostrarEliminar({{ $imagen->id }})">
								<img height="285px" src="{{ $imagen->getMinSrc() }}" class="img-responsive">
								<div id="eliminar_{{ $imagen->id }}" class="eliminar glyphicon glyphicon-trash hidden" data-toggle="modal" data-target="#modalBorrarImagen" onClick="cargarModalBorrarImagen({{$imagen->id}})"></div>
							</li>
					@endforeach
				</ul>
			</div>
			<div class="clear"></div>
			<div class="row">
				<div class="col-sm-offset-6">
					<div class="row">
						<div class="col-sm-4 right">
							<a id="botonBorrarTodas" data-toggle="modal" data-target="#modalBorrarImagens" class="btn btn-danger guardar right {{ $proyecto->imagenes()->count() > 0 ? '' : ' hidden' }}" role="button" target="_blank">Eliminar todas las im&aacute;genes</a>
						</div>
						<div class="col-sm-4 right">
							<a href="{{$proyecto->getLink()}}" class="btn btn-info guardar right" role="button" target="_blank">Ver proyecto</a>
						</div>
					</div>
	        		
	        	</div>
			</div>
		</div>


<script>
/*jslint unparam: true, regexp: true */
/*global window, $ */
$(function () {
	var rutaAbsoluta = 'http://decarlinimaside.com';
    'use strict';
    // Change this to the location of your server-side upload handler:
        
    $('#fileupload').fileupload({
        url: 'galeria/cargarImagenes',
        dataType: 'json',
        autoUpload: true,
        sequentialUploads: true,
        disableImagePreview: true,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 10000000, // 5 MB
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/
            .test(window.navigator.userAgent),
       	imageQuality: 1.0,
        previewMaxWidth: 100,
        previewMaxHeight: 100,
        previewCrop: true
    }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#porcentual').html(progress + '%');
        $('.progress-bar').css(
            'width',
            progress + '%'
        );
        if(progress == 100)
        {
	        $('#imagen-ppal').removeClass('hidden');
			$('#botonBorrarTodas').removeClass('hidden');
		}
    }).on('fileuploaddone', function (e, data) {
    	var imagen = data._response.result.nuevaImagen;
    	$('#contenedorImagenes').append('<li id="orden_' + imagen.id + '" onMouseOver="mostrarEliminar(' + imagen.id + ')" onMouseOut="mostrarEliminar(' + imagen.id + ')"><img class="img-responsive" height="285px" src="'+ rutaAbsoluta + '/' + imagen.ruta+'min/'+imagen.nombre_archivo+'"><div id="eliminar_' + imagen.id + '" class="eliminar glyphicon glyphicon-trash hidden" data-toggle="modal" data-target="#modalBorrarImagen" onClick="cargarModalBorrarImagen(' + imagen.id + ')"></div></li>');
    }).on('fileuploadfail', function (e, data) {
        alert('error');
    });
});
</script>
	<script>
		$(function()
		{
			$('#contenedorImagenes').sortable(
				{
					start: function(event, ui){ui.item.children('.eliminar').addClass('hidden');},
					stop: function(event, ui){ui.item.children('.eliminar').removeClass('hidden');actualizarOrdenGaleria({{ $proyecto->id }});}
				});
			$('#contenedorImagenes').disableSelection();
		});

		
		var form = document.querySelector('form');
		
	</script>

	<!-- Modal confirmar eliminación imagen -->
	<div class="modal fade" id="modalBorrarImagen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
		    <div class="modal-content">
		   		{{ Form::open(array('id' 		=> 'formBorrarImagen',
		   							'url' 		=> 'admin/imagenes/eliminar',
		   							'onSubmit' 	=> 'return validarBorrarImagen()',
		   							'method'	=> 'post')) }}
		   		<input id="idImagen" name="idImagen" type="hidden" value="">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
		        <h4 class="modal-title" id="myModalLabel">&iquest;Seguro que desea eliminar esta imagen?</h4>
		    </div>
		    <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
		        <button type="submit" class="btn btn-danger">Eliminar</button>
		    </div>
		      {{ Form::close() }}
		    </div>
		</div>
	</div>

	<!-- Modal confirmar eliminación todas las imagenes -->
	<div class="modal fade" id="modalBorrarImagens" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
		    <div class="modal-content">
		   		{{ Form::open(array('id' 		=> 'formBorrarImagens',
		   							'url' 		=> 'admin/imagenes/eliminarTodas',
		   							'onSubmit' 	=> 'return validarBorrarImagens()',
		   							'method'	=> 'post')) }}
		   		<input id="idProyecto" name="idProyecto" type="hidden" value="{{ $proyecto->id }}">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
		        <h4 class="modal-title" id="myModalLabel">&iquest;Seguro que desea eliminar TODAS las im&aacute;genes del proyecto "{{ $proyecto->nombre }}"?</h4>
		    </div>
		    <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
		        <button type="submit" class="btn btn-danger">Eliminar</button>
		    </div>
		      {{ Form::close() }}
		    </div>
		</div>
	</div>
		
@stop
