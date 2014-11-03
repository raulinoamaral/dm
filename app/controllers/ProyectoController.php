<?php

class ProyectoController extends \BaseController {

	/**
	 * Muestra un listado de proyectos.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$title = 'Portafolio - Decarlini Maside Arquitectura y Dise&ntilde;o - Rocha, Uruguay';
		$meta_description = '';
		$proyectos = Proyecto::OrderBy('orden')->get();
		return View::make('web.portafolio', array('title' => $title, 'meta_description' => $meta_description, 'proyectos' => $proyectos));
	}


	/**
	 * Muestra formulario para crear un nuevo proyecto.
	 *
	 * @return Response
	 */
	public function create()
	{
		$title = 'Nuevo proyecto - Benech Gerez Arquitectos &amp; Asociados';
		return View::make('admin.proyecto.create', array('title' => $title));
	}



	/**
	 * Almacena un proyecto recién creado.
	 *
	 * @return Response
	 */
	public function store()
	{
		$proyecto = new Proyecto;
		$proyecto->titulo = Input::get('titulo');
		$proyecto->ubicacion = Input::get('ubicacion');
		$proyecto->superficie = Input::get('superficie');
		$proyecto->categoria_id = Input::get('categoria');
		$proyecto->descripcion_corta = Input::get('descripcion_corta');
		$proyecto->descripcion = Input::get('descripcion');
		$proyecto->user_id = Auth::user()->id;
		$orden = 1;
		$primero = Proyecto::OrderBy('orden')->first();
		if($primero)
			$orden = $primero->orden - 1;
		$proyecto->orden = $orden;
		$proyecto->save();
		
		//if(!$categoria->programas()->find($programa->id))
		//	$categoria->programas()->save($programa);
		
		$carpeta = public_path(). '/img/proyectos/' . $proyecto->id . '/';
		mkdir($carpeta . '/min/', 0777, true);
		mkdir($carpeta . '/list/', 0777, true);
		mkdir($carpeta . '/mid/', 0777, true);
		mkdir($carpeta . '/big/', 0777, true);
		//HomeController::sitemap();
		return Response::json(['success' => true, 'proyecto' => $proyecto]);
		//return Redirect::to('admin/proyectos/' . $proyecto->id . '/galeria');
	}


	/**
	 * Muestra página para gestionar galería del proyecto especificado.
	 *
	 * @return Response
	 */
	public function gallery($id)
	{
		$title = 'Galer&iacute;a del proyecto - Benech Gerez Arquitectos &amp; Asociados';
		$proyecto = Proyecto::find($id);
		if($proyecto)
		{
			return View::make('admin.proyecto.gallery', array('title' => $title, 'proyecto' => $proyecto));
		}
		else
		{
			return Redirect::to('admin');
		}
	}


	/**
	 * Guardo archivos y creo registros de nuevas imágenes del proyecto especificado.
	 *
	 * @return Response
	 */
	public function cargarImagenes($id)
	{
		//echo "<pre>";
		//var_dump(Input::all());
		//echo "</pre>";
		//print_r(Input::get('imagen'));
		$proyecto = Proyecto::find($id);
		$carpeta = 'img/proyectos/' . $proyecto->id . '/';
		$contador = $proyecto->contadorFotos;

		if($proyecto)
		{
			$imagen = Input::file('imagen')[Input::get('numeroImagen')];
			if($imagen)
			{
				$extension = $imagen->getclientOriginalExtension();
				$nombreArchivo = $proyecto->slug . '-' . $contador . '.' . $extension;

				//BIG ONE
				$archivo = Image::make($imagen->getRealPath());
				$archivo->grab(1024, 768);
				$archivo->save(public_path() . '/' . $carpeta . 'big/' . $nombreArchivo, 90);

				//MID ONE
				$archivo = Image::make($imagen->getRealPath());
				$archivo->grab(575, 575);
				$archivo->save(public_path() . '/' . $carpeta . 'mid/' . $nombreArchivo, 90);

				//LIST ONE
				$archivo = Image::make($imagen->getRealPath());
				$archivo->grab(400, 272);
				$archivo->save(public_path() . '/' . $carpeta . 'list/' . $nombreArchivo, 90);

				//MIN ONE
				$archivo = Image::make($imagen->getRealPath());
				$archivo->grab(285, 285);
				$archivo->save(public_path() . '/' . $carpeta . 'min/' . $nombreArchivo, 90);

				$registro = new Imagen;
				$registro->ruta = $carpeta;
				$registro->orden = $contador;
				$registro->nombre_archivo = $nombreArchivo;
				$registro->proyecto_id = $proyecto->id;
				$registro->save();
				$nuevaImagen = $registro;

				$proyecto->contadorFotos = $proyecto->contadorFotos + 1;
				$proyecto->user_id = Auth::user()->id;
				$proyecto->save();
			}

			return Response::json(['success' => true, 'nuevaImagen' => $nuevaImagen]);
			/*
			$nuevasImagenes;
			foreach(Input::file('imagen') as $imagen)
			{
				$contador = $contador + 1;
				$extension = $imagen->getclientOriginalExtension();
				$nombreArchivo = $proyecto->slug . '-' . $contador . '.' . $extension;

				//BIG ONE
				$archivo = Image::make($imagen->getRealPath());
				$archivo->grab(1024, 768);
				$archivo->save(public_path() . '/' . $carpeta . 'big/' . $nombreArchivo, 80);

				//MID ONE
				$archivo = Image::make($imagen->getRealPath());
				$archivo->grab(575, 575);
				$archivo->save(public_path() . '/' . $carpeta . 'mid/' . $nombreArchivo, 80);

				//LIST ONE
				$archivo = Image::make($imagen->getRealPath());
				$archivo->grab(400, 272);
				$archivo->save(public_path() . '/' . $carpeta . 'list/' . $nombreArchivo, 80);

				//MIN ONE
				$archivo = Image::make($imagen->getRealPath());
				$archivo->grab(285, 285);
				$archivo->save(public_path() . '/' . $carpeta . 'min/' . $nombreArchivo, 80);

				$registro = new Foto;
				$registro->ruta = $carpeta;
				$registro->orden = $contador;
				$registro->nombre_archivo = $nombreArchivo;
				$registro->proyecto_id = $proyecto->id;
				$registro->save();

				$nuevasImagenes[] = $registro;

				$proyecto->contadorFotos = $proyecto->contadorFotos + 1;
				$proyecto->user_id = Auth::user()->id;
				$proyecto->save();
			}
			return Response::json(['success' => true, 'nuevasImagenes' => $nuevasImagenes]);
			*/
		}
		else
		{
			return Redirect::to('admin/proyectos');
		}
	}


	/**
	 * Muestra el proyecto especificado.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($categoriaSlug, $programaSlug, $proyectoSlug)
	{
		$programa = Programa::where('slug', '=', $programaSlug)->first();
		if(!$programa)
		{
			foreach(SlugPrograma::all() as $slug)
			{
				if($slug->slug == $programaSlug)
					$programa = $slug->programa;
			}
			if($programa)
			{
				$proyecto = Proyecto::where('slug', '=', $proyectoSlug)->first();
				if(!$proyecto)
				{
					foreach (SlugProyecto::all() as $slug)
					{
						if($slug->slug == $proyectoSlug)
							$proyecto = $slug->proyecto;
					}
				}
				return Redirect::to('proyectos/' . $categoriaSlug . '/' . $programa->slug . '/' . $proyecto->slug, 301);
			}
			return Redirect::to('proyectos');
		}
		$proyecto = $programa->proyectos()->where('slug', '=', $proyectoSlug)->first();
		if(!$proyecto)
		{
			foreach (SlugProyecto::all() as $slug)
			{
				if($slug->slug == $proyectoSlug)
					$proyecto = $slug->proyecto;
			}
			if($proyecto)
				return Redirect::to('proyectos/' . $categoriaSlug . '/' . $programa->slug . '/' . $proyecto->slug, 301);
			else
				return Redirect::to('proyectos');
		}
		$categoria = Categoria::where('slug', '=', $categoriaSlug)->first();
		$proyecto = $programa->proyectos()->where('categoria_id', '=', $categoria->id)->where('slug', '=', $proyectoSlug)->first();

		$title = $proyecto->nombre.' - Benech Gerez Arquitectos &amp; Asociados';
		return View::make('web.proyecto', array('title' => $title, 'meta_description' => $proyecto->descripcion_corta, 'proyecto' => $proyecto));	

	}

	/**
	 * Muestra el proyecto especificado.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function showPrograma($categoriaSlug, $programaSlug)
	{
		$programa = Programa::where('slug', '=', $programaSlug)->first();
		$categoria = Categoria::where('slug', '=', $categoriaSlug)->first();
		if(!$categoria)
			return Redirect::to('proyectos');
		if(!$programa)
		{
			foreach(SlugPrograma::all() as $slug)
			{
				if($slug->slug == $programaSlug)
					$programa = $slug->programa;
			}
			if($programa)
			{
				return Redirect::to('proyectos/' . $categoriaSlug . '/' . $programa->slug, 301);
			}
			return Redirect::to('proyectos');
		}

		$title = $programa->nombre.' - Benech Gerez Arquitectos &amp; Asociados';
		$proyectos = $programa->proyectos()->where('categoria_id', '=', $categoria->id)->OrderBy('orden')->get();
		return View::make('web.listadoPrograma', array('title' => $title, 'meta_description' => 'Listado de proyectos que pertenecen al programa ' . $programa->nombre . ', a cargo de Benech Gerez Arquitectos &amp; Asociados.', 'programa' => $programa, 'categoria' => $categoria, 'proyectos' => $proyectos));	

	}


	/**
	 * Muestra el formulario para editar el proyecto especificado.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$title = 'Editar proyecto - Benech Gerez Arquitectos &amp; Asociados';
		$proyecto = Proyecto::find($id);
		if($proyecto)
		{
			return View::make('admin.proyecto.edit', array('title' => $title, 'proyecto' => $proyecto));
		}
		return Redirect::to('admin');
	}


	/**
	 * Actualiza los datos del proyecto especificado.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$proyecto = Proyecto::find($id);
		//
		$actualizarSlug = false;
		$slugViejo = '';
		if($proyecto->nombre != Input::get('nombre'))
		{
			$actualizarSlug = true;
			$slugViejo = $proyecto->slug;
		}

		//
		$proyecto->nombre = Input::get('nombre');
		$proyecto->codigo = Input::get('codigo');
		$proyecto->fecha = Input::get('fecha');
		$proyecto->descripcion = Input::get('descripcion');
		$proyecto->descripcion_corta = Input::get('descripcion_corta');
		$proyecto->ubicacion = Input::get('ubicacion');
		$proyecto->superficie = Input::get('superficie');
		$proyecto->estado_id = Input::get('estado');
		$proyecto->categoria_id = Input::get('categoria');
		$proyecto->programa_id = Input::get('programa');
		$proyecto->tipo_id = Input::get('tipo');
		$proyecto->user_id = Auth::user()->id;
		$proyecto->novedad = Input::get('novedad');
		$proyecto->save();
		if($actualizarSlug)
		{
			$redireccionamiento = new SlugProyecto;
			$redireccionamiento->slug = $slugViejo;
			$redireccionamiento->proyecto_id = $proyecto->id;
			$redireccionamiento->save();
			HomeController::sitemap(); 
		}
		foreach(Responsable::all() as $responsable)
		{
			if(Input::get('R-'.$responsable->id) == '1')
			{
				if($proyecto->responsables()->find($responsable->id))
				{
					$proyecto->responsables()->updateExistingPivot($responsable->id, array('aclaracion' => Input::get('AR-'.$responsable->id, '')));
				}
				else
				{
					$proyecto->responsables()->save($responsable, array('aclaracion' => Input::get('AR-'.$responsable->id, '')));
				}
			}
			else
			{
				if($proyecto->responsables()->find($responsable->id))
				{
					$proyecto->responsables()->detach($responsable->id);
				}
			}
		}

		foreach(Colaborador::all() as $colaborador)
		{
			if(Input::get('C-'.$colaborador->id) == '1')
			{
				if($proyecto->colaboradores()->find($colaborador->id))
				{
					$proyecto->responsables()->updateExistingPivot($colaborador->id, array('aclaracion' => Input::get('AC-'.$colaborador->id, '')));
				}
				else
				{
					$proyecto->colaboradores()->save($colaborador, array('aclaracion' => Input::get('AC-'.$colaborador->id, '')));
				}
			}
			else
			{
				if($proyecto->colaboradores()->find($colaborador->id))
				{
					$proyecto->colaboradores()->detach($colaborador->id);
				}
			}
		}
		return Redirect::to('admin');
	}


	/**
	 * Elimina el registro del proyecto especificado.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
	{
		if(Request::ajax())
		{
			$idProyecto = Input::get('idProyectoEliminar');
			$proyecto = Proyecto::find($idProyecto);
			File::deleteDirectory(public_path() . '/' . 'img/proyectos/' . $proyecto->id);
			Proyecto::destroy($proyecto->id);
			HomeController::sitemap();
			return Response::json(array(
				'success'	=> true,
				'idProyecto'=> $idProyecto
				));
		}
	}

	public function eliminarImagenes()
	{
		if(Request::ajax())
		{
			$proyecto = Proyecto::find(Input::get('idProyecto'));
			foreach($proyecto->imagenes as $foto)
			{
				File::delete(public_path() . '/' . $foto->ruta . 'min/' . $foto->nombre_archivo);
				File::delete(public_path() . '/' . $foto->ruta . 'list/' . $foto->nombre_archivo);
				File::delete(public_path() . '/' . $foto->ruta . 'mid/' . $foto->nombre_archivo);
				File::delete(public_path() . '/' . $foto->ruta . 'big/' . $foto->nombre_archivo);
	           	Foto::destroy($foto->id);
			}
			return Response::json(array(
					'success' => true
					));
		}
	}

	public function cambiarEstadoNovedad($idProyecto)
	{
		$estado = Input::get('estado');
		$proyecto = Proyecto::find($idProyecto);
		if($estado == 'si')
		{
			$proyecto->novedad = true;
		}
		else
			$proyecto->novedad = false;
		$proyecto->save();
		return Response::json(array(
				'success' => true,
				'estado' => $estado
				));
	}

	public function ordenar()
	{

		if(Request::ajax())
		{
			//$proyecto = Proyecto::find(Input::get('id'));
			//orden_371,orden_372,orden_379,orden_382
			$stringOrden = Input::get('ordenes');
			$stringOrden = str_replace('proyecto_', '', $stringOrden);
			//371,372,
			$vectorOrden = preg_split("/[\s,]+/", $stringOrden);
			$contador = 1;
			foreach($vectorOrden as $idProyecto)
			{
				$proyecto = Proyecto::find($idProyecto);
				$proyecto->orden = $contador;
				$proyecto->save();
				$contador = $contador + 1;
			}
				return Response::json(array(
					'success' => true
					));
			
		}
	}

}
