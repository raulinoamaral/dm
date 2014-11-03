@extends('admin/layouts.master')
@section('content')
	@include('admin.layouts.header')
@section('script')
@parent
	{{ HTML::script('js/jquery-ui.min.js') }}
	{{ HTML::script('js/jquery.ui.touch-punch.min.js') }}

<script>
  $(function () {
    $('td, th', '#sortable').each(function () {
        var cell = $(this);
        cell.width(cell.width());
    });

    $('#sortable tbody').sortable(
    	{
    		stop: function(event, ui)
    		{
    			actualizarOrdenProyectos();
    		}
    	}).disableSelection();
});
  </script>
@stop
	<div id="notificacion"></div>
	<div class="container">
		<h1>Gesti&oacute;n de proyectos</h1>

		<div class="row">
			<div class="col-sm-6">
				<a title="Nuevo proyecto" href="{{ asset('admin/proyectos/nuevo') }}" class="btn btn-primary" role="button">Nuevo <span class="glyphicon glyphicon-plus"></span></a>
			</div>
			<div class="col-sm-6"></div>
		</div>
		<table id="sortable" class="table table-striped">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Categor&iacute;a</th>
					<th></th>
				</tr>
			</thead>
			<tbody class="contenedorAOrdenar">
				@foreach($proyectos as $proyecto)
				<tr id="proyecto_{{ $proyecto->id }}">
					<td class="nombre-proyecto">{{ $proyecto->nombre }}</td>
					<td class="proyecto" id="nombre-proyecto-{{ $proyecto->id }}">{{ $proyecto->categoria->nombre }}</td>
					<td class="botones">
						<a target="_blank" href="{{ $proyecto->getLink() }}" title="Ver proyecto"><span class="glyphicon glyphicon-new-window ver-proyecto"></span></a>
						<a href="{{ $proyecto->getLinkEditarProyecto() }}" title="Editar"><span class="glyphicon glyphicon-pencil editar"></span></a>
						<a href="{{ $proyecto->getLinkEditarGaleria() }}" title="Gestionar im&aacute;genes"><span class="glyphicon glyphicon-camera editar-galeria"></span></a>
						<a data-toggle="modal" data-target="#modalEliminarProyecto" title="Eliminar" onClick="cargarModalEliminarProyecto({{ $proyecto->id }})"><span class="glyphicon glyphicon-trash eliminar-proyecto"></span></a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		</div>
	</div>

	<!-- Modal eliminar Proyecto -->
	<div class="modal fade" id="modalEliminarProyecto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				{{ Form::open(array('id' 		=> 'formBorrarProyecto',
		   							'url' 		=> 'admin/proyecto/eliminar',
		   							'onSubmit' 	=> 'return validarBorrarProyecto()',
		   							'method'	=> 'post')) }}
		   			{{ Form::input('hidden', 'idProyectoEliminar', '', array('id' => 'idProyectoEliminar')) }}
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
						<h4 id="nombreProyecto" class="modal-title"></h4>
					</div>
					<!--<div class="modal-body">
						<p>IMPORTANTE: se eliminaran todos los proyectos bajo este programa.</p>
					</div>-->
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
						<button type="submit" class="btn btn-danger">Eliminar</button>
					</div>
				{{ Form::close() }}
			</div>
		</div>
	</div>
@stop