<?php

class ProyectoController extends \BaseController {

	/**
	 * Muestra un listado de proyectos.
	 *
	 * @return Response
	 */
	public function index()
	{
		$title = 'Decarlini Maside Arquitectura y Dise&ntilde;o - Rocha, Uruguay';
		$meta_description = '';
		$proyectos = Proyecto::OrderBy('orden')->paginate(2);
		$categorias = Categoria::all();
		return View::make('web.portafolio', array('title' => $title, 'meta_description' => $meta_description, 'proyectos' => $proyectos, 'categorias' => $categorias));
	}

	public function indexCategoria($slugCategoria)
	{
		$title = 'Decarlini Maside Arquitectura y Dise&ntilde;o - Rocha, Uruguay';
		$categoria = Categoria::where('slug', '=', $slugCategoria)->first();
		if(!$categoria)
			return Redirect::to('portafolio', 301);
		$meta_description = $categoria->descripcion;
		$proyectos = $categoria->proyectos()->paginate(2);
		$categorias = Categoria::all();
		return View::make('web.categoria', array('title' => $title, 'meta_description' => $meta_description, 'categoria' => $categoria, 'proyectos' => $proyectos, 'categorias' => $categorias));
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
		$proyecto->ano = Input::get('ano');
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
		mkdir($carpeta . '/pda/', 0777, true);
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
		$proyecto = Proyecto::find($id);
		$carpeta = 'img/proyectos/' . $proyecto->id . '/';
		$contador = $proyecto->contadorFotos;
		if($proyecto)
		{
			$imagen = Input::file('files')[0];
			if($imagen)
			{
				$extension = $imagen->getclientOriginalExtension();
				$nombreArchivo = $proyecto->slug . '-' . $contador . '.' . $extension;

				//BIG ONE
				$archivo = Image::make($imagen->getRealPath());
				if($archivo->width > 1024 || $archivo->height > 768)
				{
					if($archivo->width > $archivo->height)
					{
						//es apaisada, entonces:
						$archivo->resize(1024, null, function()
						{
							$constraint->aspectRatio();
							
						});
					}
					else
					{
						//es vertical, entonces:
						$archivo->resize(null, 1024, function()
						{
							$constraint->aspectRatio();
						});	
					}
				}
				$archivo->save(public_path() . '/' . $carpeta . 'big/' . $nombreArchivo, 90);

				//PORTADA ONE
				$archivo = Image::make($imagen->getRealPath());
				$archivo->grab(750, 252);
				$archivo->save(public_path() . '/' . $carpeta . 'pda/' . $nombreArchivo, 90);

				
				//MIN ONE
				$archivo = Image::make($imagen->getRealPath());
				$archivo->grab(375, 252);
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
				return Response::json(['success' => true, 'nuevaImagen' => $nuevaImagen]);
			}
			else
			{
				return Response::json(['success' => false]);
			}
		}

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


	/**
	 * Muestra el proyecto especificado.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($categoriaSlug, $proyectoSlug)
	{
		$categoria = Categoria::where('slug', '=', $categoriaSlug)->first();
		if($categoria)
		{
			$proyecto = Proyecto::where('slug', '=', $proyectoSlug)->first();
			if(!$proyecto)
			{
				foreach(SlugProyecto::all() as $slug)
				{
					if($slug->slug == $proyectoSlug)
					{
						$proyecto = $slug->proyecto;
						return Redirect::to('portafolio/' . $categoriaSlug . '/' . $proyecto->slug, 301);
					}
				}
			}
		}
		else
		{
			return Redirect::to('portafolio');
		}
		
		//$proyecto = $categoria->proyectos()->where('categoria_id', '=', $categoria->id)->where('slug', '=', $proyectoSlug)->first();

		$title = $proyecto->titulo.' - Benech Gerez Arquitectos &amp; Asociados';
		return View::make('web.ficha', array('title' => $title, 'meta_description' => $proyecto->descripcion_corta, 'proyecto' => $proyecto));	

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
		$title = 'Editar proyecto - Decarlini Maside';
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
		$actualizarSlug = false;
		$slugViejo = '';
		if($proyecto->titulo != Input::get('titulo'))
		{
			$actualizarSlug = true;
			$slugViejo = $proyecto->slug;
		}
		$proyecto->titulo = Input::get('titulo');
		$proyecto->ubicacion = Input::get('ubicacion');
		$proyecto->superficie = Input::get('superficie');
		$proyecto->ano = Input::get('ano');
		$proyecto->categoria_id = Input::get('categoria.id');
		$proyecto->descripcion_corta = Input::get('descripcion_corta');
		$proyecto->descripcion = Input::get('descripcion');
		$proyecto->user_id = Auth::user()->id;
		$proyecto->save();
		if($actualizarSlug)
		{
			$redireccionamiento = new SlugProyecto;
			$redireccionamiento->slug = $slugViejo;
			$redireccionamiento->proyecto_id = $proyecto->id;
			$redireccionamiento->save();
			//HomeController::sitemap(); 
		}
		return $proyecto->toJson();
	}


	/**
	 * Elimina el registro del proyecto especificado.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$idProyecto = $id;
		$proyecto = Proyecto::find($id);
		File::deleteDirectory(public_path() . '/' . 'img/proyectos/' . $proyecto->id);
		Proyecto::destroy($proyecto->id);
		//HomeController::sitemap();
		return Response::json(array(
			'success'	=> true,
			'idProyecto'=> $idProyecto
			));	
	}

	public function eliminarImagenes($id)
	{
		
			$proyecto = Proyecto::find($id);
			if($proyecto)
			{
				foreach($proyecto->imagenes as $foto)
				{
					File::delete(public_path() . '/' . $foto->ruta . 'min/' . $foto->nombre_archivo);
					File::delete(public_path() . '/' . $foto->ruta . 'pda/' . $foto->nombre_archivo);
					File::delete(public_path() . '/' . $foto->ruta . 'big/' . $foto->nombre_archivo);
		           	Imagen::destroy($foto->id);
				}
			return Response::json(array(
					'success' => true
					));
			}
			return Response::json(array(
					'success' => false
					));
			
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

	public function apiIndex()
	{
		$proyectos = Proyecto::with('categoria')->get();
		if($proyectos)
			return $proyectos->toJson();
		return '';
	}

	public function getItem($id)
	{
		$proyecto = Proyecto::with('categoria')->with('imagenes')->OrderBy('orden')->find($id);
		//$proyecto = $proyecto->with('categoria')->get();
		//
		//$user = User::with(array('categoria','proyecto.categoria'))->where('id','=',$proyecto->categoria_id)->get();
		//
		if($proyecto)
			return $proyecto->toJson();
		return '';
	}

}
