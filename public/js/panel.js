var rutaAbsoluta = 'http://decarlinimaside.com';

function mostrarAclaracion(param)
{	
	objeto = $('#'+param);
	if(objeto.hasClass('hidden'))
		objeto.removeClass('hidden');
	else
		objeto.addClass('hidden');
}

function contarCaracteres(valorActual, valorMax, idContador)
{
	caracteresRestantes = valorMax - valorActual.length;
	
	$(idContador).html(caracteresRestantes + ' caracteres restantes');
}


//Proyecto
function validarNuevoProyecto()
{
	v1 = validarInputString('nombre', 'nombreError');
	v2 = validarSelect('categoria', 'categoriaError');
	v3 = validarSelect('programa', 'programaError');
	v4 = validarSelect('tipo', 'tipoError');
	v5 = validarTextareaString('descripcion_corta', 'descripcion_cortaError');
	v6 = validarTextareaString('descripcion', 'descripcionError');
	v7 = validarSelect('estado', 'estadoError');
	if(v1 && v2 && v3 && v4 && v5 && v6)
	{

	}
	else		
		return false;
}

function validarEdicionProyecto()
{
	validarInputString('nombre', 'nombreError');
	validarSelect('programa', 'programaError');
	validarSelect('tipo', 'tipoError');
	validarTextareaString('descripcion_corta', 'descripcion_cortaError');
	validarTextareaString('descripcion', 'descripcionError');
	if(validarInputString('nombre', 'nombreError') && validarSelect('programa', 'programaError') && validarSelect('tipo', 'tipoError') && validarTextareaString('descripcion_corta', 'descripcion_cortaError') && validarTextareaString('descripcion', 'descripcionError'))
	{

	}
	else		
		return false;
}

//Programa
function validarNuevoPrograma()
{
	validarInputString('nombreNuevoPrograma', 'errorNombreNuevoPrograma');
	if(validarInputString('nombreNuevoPrograma', 'errorNombreNuevoPrograma'))
	{
		$('#modalNuevoPrograma').modal('hide');
	var form = $('#formNuevoPrograma');	
	$.ajax(
	{	
		type: 'POST',
	    url: form.attr('action'),
	    data: form.serialize(),
	    success: function(retorno)
	    {
	    	if(retorno.success)
	    	{
	    		$('#programa').empty();
	    		$('#programa').append(new Option('Seleccione un programa', 0));
				$.each(retorno.programas, function(index, element)
		    	{
		    		$('#programa').append(new Option(element.nombre, element.id));
		    	});
		    	$('#programa').val(retorno.selectedId);
				$(':input', '#formNuevoPrograma').val('');
	    	}	
	    }
	});
	}
	return false;
}

function cargarNombrePrograma(idPrograma)
{
	$('#nombrePrograma').html('&iquest;Seguro que desea eliminar el programa &quot;'+ $('#programa-'+idPrograma+'-nombre').html() + '&quot;?');
	$('#idPrograma').val(idPrograma);
}

function cargarNombreProgramaEditar(idPrograma)
{
	$('#nombreProgramaEditar').val($('#programa-'+idPrograma+'-nombre').html());
	$('#idProgramaEditar').val(idPrograma);
}


//Tipo
function validarNuevoTipo()
{
	validarInputString('nombreNuevoTipo', 'errorNombreNuevoTipo');
	if(validarInputString('nombreNuevoTipo', 'errorNombreNuevoTipo'))
	{
		$('#modalNuevoTipo').modal('hide');
		var form = $('#formNuevoTipo');	
		$.ajax(
		{	
			type: 'POST',
		    url: form.attr('action'),
		    data: form.serialize(),
		    success: function(retorno)
		    {
		    	if(retorno.success)
		    	{
		    		$('#tipo').empty();
		    		$('#tipo').append(new Option('Seleccione un tipo', 0));
					$.each(retorno.tipos, function(index, element)
			    	{
			    		$('#tipo').append(new Option(element.nombre, element.id));
			    	});
			    	$('#tipo').val(retorno.selectedId);
					$(':input', '#formNuevoTipo').val('');
		    	}	
		    }
		});
	}
	return false;
}

function cargarNombreTipo(idTipo)
{
	$('#nombreTipo').html('&iquest;Seguro que desea eliminar el tipo &quot;'+ $('#tipo-'+idTipo+'-nombre').html() + '&quot;?');
	$('#idTipo').val(idTipo);
}

function cargarNombreTipoEditar(idTipo)
{
	$('#nombreTipoEditar').val($('#tipo-'+idTipo+'-nombre').html());
	$('#idTipoEditar').val(idTipo);
}

function validarBorrarTipo()
{
	var form = $('#formBorrarTipo');	
	$.ajax(
	{	
		type: 'POST',
	    url: form.attr('action'),
	    data: form.serialize(),
	    success: function(retorno)
	    {
	    	if(retorno.success)
	    	{
	    		$('#tipo-'+retorno.idTipo).remove();
	    	}	
	    }
	});
	$('#modalEliminarTipo').modal('hide');
	return false;
}

function validarEditarTipo()
{
	valido = validarInputString('nombreTipoEditar', 'errorNombreTipoEditar');
	if(valido)
	{
		var form = $('#formEditarTipo');	
		$.ajax(
		{	
			type: 'POST',
		    url: form.attr('action'),
		    data: form.serialize(),
		    success: function(retorno)
		    {
		    	if(retorno.success)
		    	{
		    		$('#tipo-'+retorno.idTipo+'-nombre').html(retorno.nuevoNombre);
		    	}	
		    }
		});
		$('#modalEditarTipo').modal('hide');
	}
	return false;
}

//Responsable
function validarNuevoResponsable()
{
	validarInputString('nombreNuevoResponsable', 'errorNombreNuevoTipo');
	validarInputString('apellidoNuevoResponsable', 'errorApellidoNuevoTipo');
	if(validarInputString('nombreNuevoResponsable', 'errorNombreNuevoTipo') && validarInputString('apellidoNuevoResponsable', 'errorApellidoNuevoTipo'))
	{
		$('#modalNuevoResponsable').modal('hide');
		var form = $('#formNuevoResponsable');	
		$.ajax(
		{	
			type: 'POST',
		    url: form.attr('action'),
		    data: form.serialize(),
		    success: function(retorno)
		    {
		    	if(retorno.success)
		    	{
		    		$('#contenedorResponsables').append('<div class="row"><div class="colaborador"><div class="col-sm-6"><input type="checkbox" checked id="R-'+retorno.responsable.id+'" name="R-'+retorno.responsable.id+'" onClick="mostrarAclaracion(\'AR-'+retorno.responsable.id+'\')" class="responsables" value="1"><label for="R-'+retorno.responsable.id+'">'+retorno.responsable.nombre+' '+retorno.responsable.apellido+'</label></div><div class="col-sm-6"><input id="AR-'+retorno.responsable.id+'" class="aclaracionesResponsables" placeholder="Aclaraci&oacute;n opcional..." name="AR-'+retorno.responsable.id+'" type="text"></div><div class="clear"></div></div></div>');
					$(':input', '#formNuevoResponsable').val('');
		    	}	
		    }
		});
	}
	return false;
}

function validarEditarResponsable()
{
	v1 = validarInputString('nombreResponsableEditar', 'errorNombreResponsableEditar');
	v2 = validarInputString('apellidoResponsableEditar', 'errorApellidoResponsableEditar');
	if(v1 && v2)
	{
		var form = $('#formEditarResponsable');	
		$.ajax(
		{	
			type: 'POST',
		    url: form.attr('action'),
		    data: form.serialize(),
		    success: function(retorno)
		    {
		    	if(retorno.success)
		    	{
		    		$('#responsable-'+retorno.idResponsable+'-nombreApellido').html(retorno.nuevoNombre + ' ' + retorno.nuevoApellido);
		    		$('#responsable-'+retorno.idResponsable+'-nombre').val(retorno.nuevoNombre);
		    		$('#responsable-'+retorno.idResponsable+'-apellido').val(retorno.nuevoApellido);
		    	}	
		    }
		});
		$('#modalEditarResponsable').modal('hide');
	}
	return false;
}

function cargarNombreResponsable(idResponsable)
{
	$('#nombreResponsable').html('&iquest;Seguro que desea eliminar el responsable &quot;'+ $('#responsable-'+idResponsable+'-nombreApellido').html() + '&quot;?');
	$('#idResponsable').val(idResponsable);
}

function validarBorrarResponsable()
{
	var form = $('#formBorrarResponsable');	
	$.ajax(
	{	
		type: 'POST',
	    url: form.attr('action'),
	    data: form.serialize(),
	    success: function(retorno)
	    {
	    	if(retorno.success)
	    	{
	    		$('#responsable-'+retorno.idResponsable).remove();
	    	}	
	    }
	});
	$('#modalEliminarResponsable').modal('hide');
	return false;
}

//Colaborador
function validarNuevoColaborador()
{
	validarInputString('nombreNuevoColaborador', 'errorNombreNuevoTipo');
	validarInputString('apellidoNuevoColaborador', 'errorApellidoNuevoTipo');
	if(validarInputString('nombreNuevoColaborador', 'errorNombreNuevoTipo') && validarInputString('apellidoNuevoColaborador', 'errorApellidoNuevoTipo'))
	{
		$('#modalNuevoColaborador').modal('hide');
		var form = $('#formNuevoColaborador');	
		$.ajax(
		{	
			type: 'POST',
		    url: form.attr('action'),
		    data: form.serialize(),
		    success: function(retorno)
		    {
		    	if(retorno.success)
		    	{
		    		$('#contenedorColaboradores').append('<div class="row"><div class="colaborador"><div class="col-sm-6"><input type="checkbox" checked id="C-'+retorno.colaborador.id+'" name="C-'+retorno.colaborador.id+'" onClick="mostrarAclaracion(\'AC-'+retorno.colaborador.id+'\')" class="colaboradores" value="1"><label for="C-'+retorno.colaborador.id+'">'+retorno.colaborador.nombre+' '+retorno.colaborador.apellido+'</label></div><div class="col-sm-6"><input id="AC-'+retorno.colaborador.id+'" class="aclaracionesColaboradores" placeholder="Aclaraci&oacute;n opcional..." name="AC-'+retorno.colaborador.id+'" type="text"></div><div class="clear"></div></div></div>');
					$(':input', '#formNuevoColaborador').val('');
		    	}	
		    }
		});
	}
	return false;
}

function validarEditarColaborador()
{
	v1 = validarInputString('nombreColaboradorEditar', 'errorNombreColaboradorEditar');
	v2 = validarInputString('apellidoColaboradorEditar', 'errorApellidoColaboradorEditar');
	if(v1 && v2)
	{
		var form = $('#formEditarColaborador');	
		$.ajax(
		{	
			type: 'POST',
		    url: form.attr('action'),
		    data: form.serialize(),
		    success: function(retorno)
		    {
		    	if(retorno.success)
		    	{
		    		$('#colaborador-'+retorno.idColaborador+'-nombreApellido').html(retorno.nuevoNombre + ' ' + retorno.nuevoApellido);
		    		$('#colaborador-'+retorno.idColaborador+'-nombre').val(retorno.nuevoNombre);
		    		$('#colaborador-'+retorno.idColaborador+'-apellido').val(retorno.nuevoApellido);
		    	}	
		    }
		});
		$('#modalEditarColaborador').modal('hide');
	}
	return false;
}

function cargarNombreColaborador(idColaborador)
{
	$('#nombreColaborador').html('&iquest;Seguro que desea eliminar el colaborador &quot;'+ $('#colaborador-'+idColaborador+'-nombreApellido').html() + '&quot;?');
	$('#idColaborador').val(idColaborador);
}

function cargarColaboradorEditar(idColaborador)
{
	$('#nombreColaboradorEditar').val($('#colaborador-'+idColaborador+'-nombre').val());
	$('#apellidoColaboradorEditar').val($('#colaborador-'+idColaborador+'-apellido').val());
	$('#idColaboradorEditar').val(idColaborador);
}

function validarBorrarColaborador()
{
	var form = $('#formBorrarColaborador');	
	$.ajax(
	{	
		type: 'POST',
	    url: form.attr('action'),
	    data: form.serialize(),
	    success: function(retorno)
	    {
	    	if(retorno.success)
	    	{
	    		$('#colaborador-'+retorno.idColaborador).remove();
	    	}	
	    }
	});
	$('#modalEliminarColaborador').modal('hide');
	return false;
}

//Validadores
function validarInputString(idInput, idError)
{
	if($('#'+idInput).val() == '')
	{
		$('#'+idError).removeClass('hidden');
		return false;
	}
	else
	{
		$('#'+idError).addClass('hidden');
		return true;
	}

}

function validarTextareaString(idInput, idError)
{
	if($('#'+idInput).val() == '')
	{
		$('#'+idError).removeClass('hidden');
		return false;
	}
	else
	{
		$('#'+idError).addClass('hidden');
		return true;
	}
}

//this.value, 160, contadorDescripcionCorta, "descripcion_corta", "descripcion_cortaError"
//valorActual, valorMax, idContador
function contarCaracteresYValidar(valorActual, valorMax, idContador, idInput, idError)
{
	validarTextareaString(idInput, idError);
	contarCaracteres(valorActual, valorMax, idContador);
}

function validarSelect(idSelect, idError)
{
	if($('#'+idSelect).val() == '0')
	{
		$('#'+idError).removeClass('hidden');
		return false;
	}
	else
	{
		$('#'+idError).addClass('hidden');
		return true;
	}
}

function cargarImagenes()
{
	$('#progreso').show();
	$("body").css("cursor", "progress");
	var request = new XMLHttpRequest();
	var formdata = new FormData(form);
	total = $('#imagen')[0].files.length;
	request.open('post', 'galeria/cargarImagenes');
	request.send(formdata);

	request.addEventListener('load', function(e)
			{
				numActual = parseInt($('#numeroImagen').val());
				porcentaje = ((numActual + 1) * 100) / total;

				$('#progreso').removeClass('hidden');
				$('#progreso').css('width', porcentaje+'%');
				retorno = JSON.parse(e.target.responseText);

				//alert(retorno.nuevasImagenes[0].nombre_archivo);
				
				//proximo = numActual + 1;
				//$('#numeroImagen').val(proximo);
				/*while(contador < retorno.nuevasImagenes.length)
				{
					imagen = retorno.nuevasImagenes[contador];
					contador++;
					$('#contenedorImagenes').append('<li id="orden"><img height="100px" src="'+ rutaAbsoluta + '/' + imagen.ruta+'1/'+imagen.nombre_archivo+'"><input id="description_" maxlength="50" class="descripcion" placeholder="Descripción" name="name" type="text" value="descripcion"><input id="imagenPortada" class="imagenPortada" checked="checked" name="imagenPortada" type="radio" value="id"> Imagen de portada<br><input id="imagenResultado" class="imagenResultado" checked="checked" name="imagenResultado" type="radio" value="id"> Imagen de resultados<br><input name="eliminarImagen" type="checkbox" value=""> Eliminar imagen<br></li>');
				}
				*/

				//
				imagen = retorno.nuevaImagen;
				$('#contenedorImagenes').append('<li id="orden_' + imagen.id + '" onMouseOver="mostrarEliminar(' + imagen.id + ')" onMouseOut="mostrarEliminar(' + imagen.id + ')"><img class="img-responsive" height="285px" src="'+ rutaAbsoluta + '/' + imagen.ruta+'min/'+imagen.nombre_archivo+'"><div id="eliminar_' + imagen.id + '" class="eliminar glyphicon glyphicon-trash hidden" data-toggle="modal" data-target="#modalBorrarImagen" onClick="cargarModalBorrarImagen(' + imagen.id + ')"></div></li>');

				if(numActual + 1 < total)
				{
					numActual = parseInt($('#numeroImagen').val());
				proximo = numActual + 1;
				$('#numeroImagen').val(proximo);
					cargarImagenes();
				}
				else
				{
					$('#numeroImagen').val(0);
					$('#progreso').css('width', '100%').delay(800).fadeOut();
					setTimeout(function(){$('#progreso').css('width', '0%');}, 1200);
					setTimeout(function(){$('#progreso').show();}, 1000);
					$("body").css("cursor", "default");

					//$('#progreso').addClass('hidden');
					//$('#progreso').css('width', '0%');
				}
				//

			}, false);
}

function cargarModalBorrarImagen(idImagen)
{
	$('#idImagen').val(idImagen);
}

function validarBorrarImagen()
{
	var form = $('#formBorrarImagen');
	var hayPlano = '0';
	if($('#esPlano').prop('checked'))
		hayPlano = '1';	
	$.ajax(
	{	
		type: 'POST',
	    url: form.attr('action'),
	    data: form.serialize() + '&hayPlano=' + hayPlano,
	    success: function(retorno)
	    {
	    	if(retorno.success)
	    	{
	    		$('#orden_'+retorno.idImagen).remove();
	    		if($('#contenedorImagenes li').length < 2)
	        		$('#imagen-plano').addClass('hidden');
	    		if(retorno.sinImagenes)
	    		{
	    			$('#imagen-ppal').addClass('hidden');
	    			$('#botonBorrarTodas').addClass('hidden');
	    		}
	    	}	
	    }
	});
	$('#modalBorrarImagen').modal('hide');
	return false;
}

function validarBorrarImagenes()
{
	var form = $('#formBorrarImagenes');	
	$.ajax(
	{	
		type: 'POST',
	    url: form.attr('action'),
	    data: form.serialize(),
	    success: function(retorno)
	    {
	    	if(retorno.success)
	    	{
	    		$('#imagen-plano').addClass('hidden');
	    		$('#contenedorImagenes').html('');
	    		$('#imagen-ppal').addClass('hidden');
	    		$('#imagen-plano').addClass('hidden');
	    		$('#botonBorrarTodas').addClass('hidden');
	    	}	
	    }
	});
	$('#modalBorrarImagenes').modal('hide');
	return false;
}

function cargarResponsableEditar(idResponsable)
{
	$('#nombreResponsableEditar').val($('#responsable-'+idResponsable+'-nombre').val());
	$('#apellidoResponsableEditar').val($('#responsable-'+idResponsable+'-apellido').val());
	$('#idResponsableEditar').val(idResponsable);
}

function validarBorrarPrograma()
{
	var form = $('#formBorrarPrograma');	
	$.ajax(
	{	
		type: 'POST',
	    url: form.attr('action'),
	    data: form.serialize(),
	    success: function(retorno)
	    {
	    	if(retorno.success)
	    	{
	    		$('#programa-'+retorno.idPrograma).remove();
	    	}	
	    }
	});
	$('#modalEliminarPrograma').modal('hide');
	return false;
}

function validarEditarPrograma()
{
	valido = validarInputString('nombreProgramaEditar', 'errorNombreProgramaEditar');
	if(valido)
	{
		var form = $('#formEditarPrograma');	
		$.ajax(
		{	
			type: 'POST',
		    url: form.attr('action'),
		    data: form.serialize(),
		    success: function(retorno)
		    {
		    	if(retorno.success)
		    	{
		    		$('#programa-'+retorno.idPrograma+'-nombre').html(retorno.nuevoNombre);
		    	}	
		    }
		});
		$('#modalEditarPrograma').modal('hide');
	}
	return false;
}

function actualizarOrdenGaleria(id)
{
	var sorted = $( ".selector" ).sortable("toArray");
	//console.log('id='+id+'&sorted='+sorted);
	$.ajax(
	{	
		type: 'POST',
	    url: rutaAbsoluta+'/admin/imagenes/ordenar',
	    data: 'id='+id+'&sorted='+sorted,
	    beforeSend: function()
	    {
	    	$('#notificacion').html('Guardando...');
	    	$('#notificacion').fadeIn();
	    },
	    success: function(retorno)
	    {
	    	if(retorno.success)
	    	{
	    		$('#tipo-'+retorno.idTipo+'-nombre').html(retorno.nuevoNombre);
	    		$('#notificacion').html('Guardado!').delay(1500).fadeOut();

	    	}	
	    }
	});
}

function validarCambioClave()
{
	$('#errorClave').addClass('hidden');
	$('#errorClaveNueva').addClass('hidden');
	$('#errorClaveNueva_confirmation').addClass('hidden');
	$('#claveActualizada').addClass('hidden');
	
	var form = $('#formCambioClave');
	$.ajax(
	{
		type: form.attr('method'),
		url: rutaAbsoluta+'/admin/cambiarClave',
		data: form.serialize(),
		success: function(retorno)
		{
			if(retorno.ok)
			{
				if(retorno.valida)
				{
					$('#claveActualizada').removeClass('hidden');
					$('#clave').val('');
					$('#claveNueva').val('');
					$('#claveNueva_confirmation').val('');
				}
				else
				{
					$('#errorClaveNueva_confirmation').removeClass('hidden');
				}
			}
			else
			{
				$('#errorClave').removeClass('hidden');
				$('#clave').val('').focus();
				$('#claveNueva').val('');
				$('#claveNueva_confirmation').val('');
			}
		}
	});
	


	return false;
}

function mostrarEliminar(idImagen)
{
	$("#eliminar_"+idImagen).toggleClass("hidden");
}

function cargarModalEliminarProyecto(idProyecto)
{
	$('#nombreProyecto').html('&iquest;Seguro que desea eliminar el proyecto &quot;'+ $('#nombre-proyecto-'+idProyecto).html() + '&quot;?');
	$('#nombreProyectoEliminar').val($('#nombre-proyecto-'+idProyecto).html());
	$('#idProyectoEliminar').val(idProyecto);
}

function validarBorrarProyecto()
{
	var form = $('#formBorrarProyecto');	
	$.ajax(
	{	
		type: 'POST',
	    url: form.attr('action'),
	    data: form.serialize(),
	    success: function(retorno)
	    {
	    	if(retorno.success)
	    	{
	    		$('#proyecto_'+retorno.idProyecto).remove();
	    	}	
	    }
	});
	$('#modalEliminarProyecto').modal('hide');
	return false;
}

function validarRecuperarClave()
{
	var form = $('#formRecuperarClave');
	$.ajax(
	{	
		type: 'POST',
	    url: form.attr('action'),
	    data: form.serialize(),
	    beforeSend: function()
	    {
	    	$('#success').addClass('hidden');
	    	$('#error').addClass('hidden');
	    	$('#botonRecuperar').attr("disabled");
            $('#botonRecuperar').addClass('disabled');
            $('#botonRecuperar').val('ENVIANDO...');
	    },
	    success: function(retorno)
	    {
	    	if(retorno.success)
	    	{
	    		$('#success').removeClass('hidden');
	    		$('#error').addClass('hidden');
	    		$('#botonRecuperar').attr("disabled", false);
	            $('#botonRecuperar').removeClass('disabled');
	            $('#botonRecuperar').val('RECUPERAR CLAVE');
	            form[0].reset();
	    	}
	    	else
	    	{
	    		$('#success').addClass('hidden');
	    		$('#error').removeClass('hidden');
	    		$('#botonRecuperar').attr("disabled", false);
	            $('#botonRecuperar').removeClass('disabled');
	            $('#botonRecuperar').val('RECUPERAR CLAVE');
	    	}	
	    }
	});
	return false;
}

function validarNuevaClave()
{
	var form = $('#formNuevaClave');
	$.ajax(
	{	
		type: 'POST',
	    url: form.attr('action'),
	    data: form.serialize(),
	    beforeSend: function()
	    {
	    	$('#emailError').addClass('hidden');
	    	$('#passwordError').addClass('hidden');
	    	$('#success').addClass('hidden');
	    	$('#botonGuardar').attr("disabled");
            $('#botonGuardar').addClass('disabled');
            $('#botonGuardar').val('GUARDANDO...');
	    },
	    success: function(retorno)
	    {
	    	if(retorno.success)
	    	{
	    		$('#success').removeClass('hidden');
	    		$('#removible').empty();
	    	}
	    	else
	    	{
	    		$('#success').addClass('hidden');
	    		if(!retorno.email)
	    		{
	    			$('#emailError').removeClass('hidden');
	    		}
	    		if(!retorno.password)
	    		{
	    			$('#passwordError').removeClass('hidden');
	    		}
	    		$('#botonGuardar').attr("disabled", false);
	            $('#botonGuardar').removeClass('disabled');
	            $('#botonGuardar').val('GUARDAR');
	    	}	
	    }
	});
	return false;
}






