
@extends('admin/layouts.master')
@section('content')
	@include('admin.layouts.header')
	<div class="container">
		<h1>Nuevo proyecto</h1>
		{{ Form::open(array(
				'id' => 'formEditarProyecto',
				'method' => 'post',
				'onSubmit' => 'return validarEdicionProyecto()',
				'url' => 'admin/proyectos/'.$proyecto->id.'/actualizar')) }}
			<div class="row">
				<div class="col-sm-3">
					{{ Form::label('Nombre') }}
					{{ Form::text('nombre', $proyecto->nombre, array(
								        	'id' => 'nombre',
								        	'onBlur' => 'validarInputString("nombre", "nombreError")',
								        	'onKeyUp' => 'validarInputString("nombre", "nombreError")')) }}
					<div id="nombreError" class="alert alert-danger hidden">
			        	Escriba el nombre del proyecto.
			        </div>
			    </div>
			    <div class="col-sm-3">
					{{ Form::label('C&oacute;digo') }}
					{{ Form::text('codigo', $proyecto->codigo, array(
								        	'id' => 'codigo')) }}
				</div>
				<div class="col-sm-3">
					{{ Form::label('Fecha') }}
					{{ Form::text('fecha', $proyecto->fecha, array(
								        	'id' => 'fecha')) }}
				</div>
				<div class="col-sm-3">
					{{ Form::label('Ubicaci&oacute;n') }}
					{{ Form::text('ubicacion', $proyecto->ubicacion, array(
								        	'id' => 'ubicacion')) }}
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3">
					{{ Form::label('Superficie') }}
					<div class="input-group">
						{{ Form::text('superficie', $proyecto->superficie, array('id' => 'superficie', 'class' => 'form-control')) }}
			  			<span class="input-group-addon">m&sup2;</span>
					</div>
				</div>
				<div class="col-sm-3">
					{{ Form::label('Estado') }}
					{{ Form::select('estado',
											array('0' => 'Seleccione un estado') + Estado::orderBy('nombre')->lists('nombre', 'id'), $proyecto->estado->id, array('id' => 'estado', 'onChange' => 'validarSelect("estado", "estadoError")')) }}
					<div id="estadoError" class="alert alert-danger hidden">
			        	Seleccione un estado.
			        </div>
				</div>
				<div class="col-sm-3">
					{{ sprintf(Form::label(null, '%s'), '&iquest;Es novedad? <input type="checkbox" ' . $proyecto->getNovedad() . ' id="novedad" name="novedad" value="1">') }}
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					{{ Form::label('Categor&iacute;a') }}
					{{ Form::select('categoria',
											array('0' => 'Seleccione una categor&iacute;a') + Categoria::orderBy('nombre')->lists('nombre', 'id'), $proyecto->categoria->id, array('id' => 'categoria', 'onChange' => 'validarSelect("categoria", "categoriaError")')) }}
					<div id="categoriaError" class="alert alert-danger hidden">
			        	Seleccione una categor&iacute;a.
			        </div>
				</div>
				<div class="col-sm-4">
					{{ Form::label('Programa') }}
					{{ Form::select('programa',
											array('0' => 'Seleccione un programa') + Programa::orderBy('nombre')->lists('nombre', 'id'), $proyecto->programa->id, array('id' => 'programa', 'onChange' => 'validarSelect("programa", "programaError")')) }}
					<button title="Agregar nuevo programa" type="button" class="btn btn-primary btn-sm right" data-toggle="modal" data-target="#modalNuevoPrograma">
						<span class="glyphicon glyphicon-plus">
					</button>
					<div id="programaError" class="alert alert-danger hidden">
			        	Seleccione un programa.
			        </div>
				</div>
				<div class="col-sm-4">
					{{ Form::label('Tipo') }}
					{{ Form::select('tipo',
							array('0' => 'Seleccione un tipo') + Tipo::orderBy('nombre')->lists('nombre', 'id'),
							$proyecto->tipo->id,
							array('id' => 'tipo',
							'onChange' => 'validarSelect("tipo", "tipoError")')) }}
					<button title="Agregar nuevo tipo" type="button" class="btn btn-primary btn-sm right" data-toggle="modal" data-target="#modalNuevoTipo">
						<span class="glyphicon glyphicon-plus">
					</button>
					<div id="tipoError" class="alert alert-danger hidden">
			        	Seleccione un tipo.
			        </div>
				</div>
			</div>
			
			<section id="responsables-colaboradores">
				<div class="row">
					<div class="col-sm-6">
						<h2>Responsable(s)</h2>
						<div id="contenedorResponsables">
							@foreach(Responsable::orderBy('apellido')->orderBy('nombre')->get() as $responsable)
								<div class="row">
									<div class="colaborador">
										<div class="col-sm-6">
											<input type="checkbox" {{ $proyecto->responsableChecked($responsable->id) }} id="R-{{ $responsable->id }}" name="R-{{ $responsable->id }}" onClick="mostrarAclaracion('AR-{{ $responsable->id }}')" class="responsables" value="1">
											<label for="R-{{ $responsable->id }}">{{ $responsable->nombre }} {{ $responsable->apellido }}</label>
										</div>
										<div class="col-sm-6">
											{{ Form::text('AR-'.$responsable->id,
														$proyecto->AR($responsable->id),
														array('id'			=> 'AR-'.$responsable->id,
															'class'			=> 'aclaracionesResponsables ' . $proyecto->aRHidden($responsable->id),
															'placeholder' 	=> 'Aclaraci&oacute;n opcional...')) }}
										</div>
									<div class="clear"></div>
									</div>
								</div>
							@endforeach()
						</div>
						<div class="clear"></div>
						<button title="Agregar nuevo responsable" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalNuevoResponsable">
							<span class="glyphicon glyphicon-plus">
						</button>
					</div>
					<div class="col-sm-6">
						<h2>Colaborador(es)</h2>
						<div id="contenedorColaboradores">
							@foreach(Colaborador::orderBy('apellido')->orderBy('nombre')->get() as $colaborador)
								<div class="row">
									<div class="colaborador">
										<div class="col-sm-6">
											<input type="checkbox" {{ $proyecto->colaboradorChecked($colaborador->id) }} id="C-{{ $colaborador->id }}" name="C-{{ $colaborador->id }}" onClick="mostrarAclaracion('AC-{{ $colaborador->id }}')" class="colaboradores" value="1">
											<label for="C-{{ $colaborador->id }}">{{ $colaborador->nombre }} {{ $colaborador->apellido }}</label>
										</div>
										<div class="col-sm-6">
											{{ Form::text('AC-'.$colaborador->id,
													$proyecto->AC($colaborador->id),
													array('id'			=> 'AC-'.$colaborador->id,
														'class'			=> 'aclaracionesColaboradores ' . $proyecto->aCHidden($colaborador->id),
														'placeholder' 	=> 'Aclaraci&oacute;n opcional...')) }}
										</div>
										<div class="clear"></div>
									</div>
								</div>
							@endforeach()
						</div>
						<button title="Agregar nuevo colaborador" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalNuevoColaborador">
							<span class="glyphicon glyphicon-plus">
						</button>
					</div>
				</div>
			</section>
			<div class="row">
				<div class="col-sm-6">
					{{ sprintf(Form::label(null, '%s'), 'Descripci&oacute;n corta <span id="contadorDescripcionCorta"></span>') }}
					{{ Form::textarea('descripcion_corta',
										$proyecto->descripcion_corta,
										array('id' => 'descripcion_corta',
												'maxlength' => 	'160',
												'onKeyUp' 	=> 	'contarCaracteresYValidar(this.value, 160, contadorDescripcionCorta, "descripcion_corta", "descripcion_cortaError")',
												'onKeyDown' => 	'contarCaracteresYValidar(this.value, 160, contadorDescripcionCorta, "descripcion_corta", "descripcion_cortaError")',
												'onBlur'	=>	'validarTextareaString("descripcion_corta", "descripcion_cortaError")')
											) }}
					<div id="descripcion_cortaError" class="alert alert-danger hidden">
			        	Escriba una descripción corta.
			        </div>
			    </div>
			    <div class="col-sm-6">
					{{ Form::label('Descripci&oacute;n completa') }}
					{{ Form::textarea('descripcion',
										$proyecto->descripcion,
										array('id' 			=> 	'descripcion',
												'onKeyUp'	=>	'validarTextareaString("descripcion", "descripcionError")',
												'onBlur'	=>	'validarTextareaString("descripcion", "descripcionError")')
											) }}
					<div id="descripcionError" class="alert alert-danger hidden">
			        	Escriba una descripción.
			        </div>
			    </div>
	        </div>
	        <div class="row">
	        	<div class="col-xs-6 col-sm-2 right">
	        		{{ Form::submit('GUARDAR', array('class'=>'guardar btn btn-success')) }}
	        	</div>
	        	<div class="col-xs-6 col-sm-2 right">
	        		<a href="/admin" class="btn btn-warning cancelar" role="button">CANCELAR</a>
	        	</div>
	        </div>
			
		{{ Form::close() }}
		<!-- Modal nuevo Programa -->
		<div class="modal fade" id="modalNuevoPrograma" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		   		{{ Form::open(array('id'  		=> 'formNuevoPrograma',
		   							'url' 		=> 'admin/programas/guardar',
		   							'onSubmit'	=> 'return validarNuevoPrograma()',
		   							'method'	=> 'post')) }}
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
		        <h4 class="modal-title" id="myModalLabel">Nuevo programa</h4>
		      </div>
		      <div class="modal-body">
		      		{{ Form::text('nombreNuevoPrograma',
		      						null,
		      						array('id' 				=> 'nombreNuevoPrograma',
		      								'placeholder' 	=> 'Ejemplo: Cl&iacute;nica m&eacute;dica')) }}
		      		<div id="errorNombreNuevoPrograma" class="alert alert-danger hidden">
			        	Escriba el nombre del programa.
			        </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
		        <button type="submit" class="btn btn-primary">Guardar</button>
		      </div>
		      {{ Form::close() }}
		    </div>
		  </div>
		</div>



		<!-- Modal nuevo Tipo -->
		<div class="modal fade" id="modalNuevoTipo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		   		{{ Form::open(array('id' 		=> 'formNuevoTipo',
		   							'url' 		=> 'admin/tipos/guardar',
		   							'onSubmit' 	=> 'return validarNuevoTipo()',
		   							'method'	=> 'post')) }}
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
		        <h4 class="modal-title" id="myModalLabel">Nuevo tipo</h4>
		      </div>
		      <div class="modal-body">
		      		{{ Form::text('nombreNuevoTipo',
		      						null,
		      						array('id'				=> 'nombreNuevoTipo',
		      								'placeholder' 	=> 'Ejemplo: Reforma y ampliaci&oacute;n')) }}
		      		<div id="errorNombreNuevoTipo" class="alert alert-danger hidden">
			        	Escriba el nombre del tipo.
			        </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
		        <button type="submit" class="btn btn-primary">Guardar</button>
		      </div>
		      {{ Form::close() }}
		    </div>
		  </div>
		</div>
		<!-- Modal nuevo Responsable -->
		<div class="modal fade" id="modalNuevoResponsable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		   		{{ Form::open(array('id' 		=> 'formNuevoResponsable',
		   							'url' 		=> 'admin/responsables/guardar',
		   							'onSubmit' 	=> 'return validarNuevoResponsable()',
		   							'method'	=> 'post')) }}
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
		        <h4 class="modal-title" id="myModalLabel">Nuevo responsable</h4>
		      </div>
		      <div class="modal-body">
		      	{{ Form::label('Nombre') }}
		      		{{ Form::text('nombreNuevoResponsable',
		      						null,
		      						array('id'				=> 'nombreNuevoResponsable',
		      								'placeholder' 	=> 'Ejemplo: Arq. Ignacio')) }}
		      		<div id="errorNombreNuevoResponsable" class="alert alert-danger hidden">
			        	Escriba el nombre.
			        </div>
			    {{ Form::label('Apellido') }}
		      		{{ Form::text('apellidoNuevoResponsable',
		      						null,
		      						array('id'				=> 'nombreNuevoResponsable',
		      								'placeholder' 	=> 'Ejemplo: Gerez')) }}
		      		<div id="errorApellidoNuevoResponsable" class="alert alert-danger hidden">
			        	Escriba el apellido.
			        </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
		        <button type="submit" class="btn btn-primary">Guardar</button>
		      </div>
		      {{ Form::close() }}
		    </div>
		  </div>
		</div>
		<!-- Modal nuevo Colaborador -->
		<div class="modal fade" id="modalNuevoColaborador" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		   		{{ Form::open(array('id' 		=> 'formNuevoColaborador',
		   							'url' 		=> 'admin/colaboradores/guardar',
		   							'onSubmit' 	=> 'return validarNuevoColaborador()',
		   							'method'	=> 'post')) }}
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
		        <h4 class="modal-title" id="myModalLabel">Nuevo colaborador</h4>
		      </div>
		      <div class="modal-body">
		      	{{ Form::label('Nombre') }}
		      		{{ Form::text('nombreNuevoColaborador',
		      						null,
		      						array('id'				=> 'nombreNuevoColaborador',
		      								'placeholder' 	=> 'Ejemplo: Arq. Juan')) }}
		      		<div id="errorNombreNuevoColaborador" class="alert alert-danger hidden">
			        	Escriba el nombre.
			        </div>
			 	{{ Form::label('Apellido') }}
		      		{{ Form::text('apellidoNuevoColaborador',
		      						null,
		      						array('id'				=> 'nombreNuevoResponsable',
		      								'placeholder' 	=> 'Ejemplo: P&eacute;rez')) }}
		      		<div id="errorApellidoNuevoColaborador" class="alert alert-danger hidden">
			        	Escriba el apellido.
			        </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
		        <button type="submit" class="btn btn-primary">Guardar</button>
		      </div>
		      {{ Form::close() }}
		    </div>
		  </div>
		</div>
	</div>
@stop