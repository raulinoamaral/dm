<?php

class ImagenController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		
			$proyecto = Proyecto::find($id);
			//orden_371,orden_372,orden_379,orden_382
			$stringOrden = Input::get('sorted');
			$vectorOrden = str_replace('orden_', '', $stringOrden);
			//371,372,
			//$vectorOrden = preg_split("/[\s,]+/", $stringOrden);
			$contador = 1;

			foreach($vectorOrden as $index => $idImagen)
			{
				$imagen = $proyecto->imagenes()->find($idImagen);
				$imagen->orden = $contador;
				$imagen->save();
				$contador = $contador + 1;
			}
				return Response::json(array(
					'success' => true, 'ordenes' => $proyecto->imagenes
					));
			
	}


	/**
	 * Remove the resource from storage.
	 *
	 * 
	 * @return Response
	 */
	public function destroy($id)
	{
		$imagen = Imagen::find($id);
		$proyecto = $imagen->proyecto;
		$ordenImagen = $imagen->orden;
		File::delete(public_path() . '/' . $imagen->ruta . 'min/' . $imagen->nombre_archivo);
		File::delete(public_path() . '/' . $imagen->ruta . 'pda/' . $imagen->nombre_archivo);
		File::delete(public_path() . '/' . $imagen->ruta . 'big/' . $imagen->nombre_archivo);
       	Imagen::destroy($id);
       	if($imagen->proyecto->imagenes()->count() > 0)
		{
			return Response::json(array(
				'success' => true,
				'idImagen' => $id,
				'sinImagenes' => false
				));
		}
		else
		{
			return Response::json(array(
				'success' => true,
				'idImagen' => $id,
				'sinImagenes' => true
				));
		}
			
	}


}
