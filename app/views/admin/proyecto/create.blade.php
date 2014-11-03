
@extends('admin/layouts.master')
@section('content')
	@include('admin.layouts.header')
	<div class="container">
		<h1>Nuevo proyecto</h1>
		<form name="formNuevoProyecto" id="formNuevoProyecto" novalidate ng-controller="ProyectoController as proyectoCtrl" ng-submit="formNuevoProyecto.$valid && proyectoCtrl.addProyecto()">
			<div class="row">
				<div class="col-sm-3">
					{{ Form::label('T&iacute;tulo') }}
					{{ Form::text('titulo', null, array(
								        	'id' 		=> 'titulo',
								        	'ng-model' 	=> 'proyectoCtrl.proyecto.titulo',
								        	'required')) }}
					<div class="alert alert-danger" ng-show="proyectoCtrl.submitted && formNuevoProyecto.titulo.$invalid">
			        	Escriba el t&iacute;tutlo del proyecto.
			        </div>
			    </div>
				<div class="col-sm-3">
					{{ Form::label('Ubicaci&oacute;n') }}
					{{ Form::text('ubicacion', null, array(
								        	'id' 		=> 'ubicacion',
								        	'ng-model' 	=> 'proyectoCtrl.proyecto.ubicacion',
								        	'required')) }}
					<div class="alert alert-danger" ng-show="proyectoCtrl.submitted && formNuevoProyecto.ubicacion.$invalid">
			        	Escriba la ubicaci&oacute;n del proyecto.
			        </div>
				</div>
				<div class="col-sm-3">
					{{ Form::label('Superficie') }}
					<div class="input-group">
						{{ Form::text('superficie', null, array(
															'id'	=> 'superficie',
															'class' => 'form-control',
														'ng-model'	=> 'proyectoCtrl.proyecto.superficie',
														'required')) }}
			  			<span class="input-group-addon">m&sup2;</span>
					</div>
					<div class="alert alert-danger" ng-show="proyectoCtrl.submitted && formNuevoProyecto.superficie.$invalid">
			        	Escriba la superficie del proyecto.
			        </div>
				</div>
				<div class="col-sm-3">
					{{ Form::label('A&ntilde;o') }}
					{{ Form::text('ano', null, array(
								        	'id' => 'ano',
								        	'ng-model' => 'proyectoCtrl.proyecto.ano',
								        	'required')) }}
					<div class="alert alert-danger" ng-show="proyectoCtrl.submitted && formNuevoProyecto.ano.$invalid">
			        	Escriba el a&ntilde;o del proyecto.
			        </div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3">
					{{ Form::label('Categor&iacute;a') }}
					{{ Form::select('categoria',
											array('' => 'Seleccione una categor&iacute;a') + Categoria::orderBy('nombre')->lists('nombre', 'id'), '', array('id' => 'categoria', 'ng-model' => 'proyectoCtrl.proyecto.categoria', 'required')) }}
					<div class="alert alert-danger" ng-show="proyectoCtrl.submitted && formNuevoProyecto.categoria.$error.required">
			        	Seleccione una categor&iacute;a.
			        </div>
				</div>
				
				
			</div>
			
			
			<div class="row">
				<div class="col-sm-6">
					{{ sprintf(Form::label(null, '%s'), 'Descripci&oacute;n corta (160 caracteres recomendades) <span ng-show="formNuevoProyecto.descripcion_corta.$dirty" id="contadorDescripcionCorta">(( 160 - proyectoCtrl.proyecto.descripcion_corta.length ))</span>') }}
					{{ Form::textarea('descripcion_corta',
										null,
										array('id' => 'descripcion_corta',
												'ng-model' 	=> 'proyectoCtrl.proyecto.descripcion_corta',
												'ng-trim'	=> 'false',
												'required'
											)) }}
					<div class="alert alert-danger" ng-show="proyectoCtrl.submitted && formNuevoProyecto.descripcion_corta.$error.required">
			        	Escriba una descripción corta.
			        </div>
			    </div>
			    <div class="col-sm-6">
					{{ Form::label('Descripci&oacute;n completa') }}
					{{ Form::textarea('descripcion',
										null,
										array('id' 			=> 	'descripcion',
										'ng-model'	=>	'proyectoCtrl.proyecto.descripcion',
												'required',
												'ng-trim'	=> 'false'
											)) }}
					<div class="alert alert-danger" ng-show="proyectoCtrl.submitted && formNuevoProyecto.descripcion.$error.required">
			        	Escriba una descripción.
			        </div>
			    </div>
	        </div>
	        <div class="row">
	        	<div class="col-xs-6 col-sm-2 right">
	        		{{ Form::submit('GUARDAR', array('class'=>'guardar btn btn-success', 'ng-click' => 'proyectoCtrl.submitted=true')) }}
	        	</div>
	        	<div class="col-xs-6 col-sm-2 right">
	        		<a href="/admin" class="btn btn-warning cancelar" role="button">CANCELAR</a>
	        	</div>
	        </div>
		</form>
	</div>
@stop