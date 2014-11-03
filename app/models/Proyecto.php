<?php 
class Proyecto extends  Eloquent 
{
	protected $table = 'proyecto';

	public static $sluggable = array(
        'build_from' => 'titulo',
        'save_to'    => 'slug',
    );

/*
	public static $rules = array(
				'name' => 'required|max:150',
				'nameEn' => 'required|max:150',
				'codigo' => 'sometimes|required|unique:propiedad',
				'zona_id' => 'required|exists:zona,id',
				'short_description' => 'required',
				'short_descriptionEn' => 'required',
				'description' => 'required',
				'descriptionEn' => 'required',
				'categoria_id' => 'required|exists:categoria,id'
			);

	public static $messages = array(
	            'name.required' => 'Campo obligatorio.',
	            'namEn.required' => 'Obligatorio.',
	            'max' => 'Supera el largo permitido.',
	            'categoria_id.exists' => 'Debe seleccionar una categoría.',
	            'codigo.required' => 'Escriba un c&oacute;digo &uacute;nico.',
	            'codigo.unique' => 'Este c&oacute;digo ya existe, escriba otro.'
	        );

	public static function validate($data)
	{
		return Validator::make($data, static::$rules, static::$messages);
	}

	*/

	public function categoria()
	{
		return $this->belongsTo('Categoria');
	}

	public function imagenes()
	{
		return $this->hasMany('Imagen');
	}

	public function slugs()
	{
		return $this->hasMany('SlugProyecto');
	}

	public function getLink()
	{
		return asset('proyectos/' . $this->categoria->slug . '/' .$this->slug);
	}

	public function getLinkCategoria()
	{
		return asset('proyectos/' . $this->categoria->slug);
	}

	public function getLinkEditarProyecto()
	{
		return asset('admin/proyectos/'.$this->id.'/editar');
	}
	public function getLinkEditarGaleria()
	{
		return asset('admin/proyectos/'.$this->id.'/galeria');
	}

	public function getFotoResultadoSrc()
	{
		$foto = $this->fotos()->OrderBy('orden')->get()->first();
		if($foto)
			return asset($foto->ruta.'list/'.$foto->nombre_archivo);
		else
			return asset('img/proyecto-sin-img.jpg');
	}

	/*public function fotoPortada()
	{
		$foto = $this->fotos()->OrderBy('orden')->get()->first();
		if($foto)
		return $foto;
	return null;
	}

	public function tieneFotos()
	{
		if($this->fotos()->count() > 0)
			return true;
		return false;
	}

	public function tieneMasdeUnaFoto()
	{
		if($this->fotos()->count() > 1)
			return true;
		return false;
	}

	public function tieneMasdeCuatroFotos()
	{
		if($this->fotos()->count() > 1)
			return true;
		return false;
	}

	public function cuatroFotos()
	{
		return $this->fotos()->OrderBy('orden')->take(4)->skip(1)->get();
	}

	public function restoFotos()
	{
		return $this->fotos()->OrderBy('orden')->take(1000)->skip(5)->get();
	}

	public function responsableChecked($idResponsable)
	{
		if($this->responsables()->find($idResponsable))
			return 'checked';
		return '';
	}

	public function colaboradorChecked($idColaborador)
	{
		if($this->colaboradores()->find($idColaborador))
			return 'checked';
		return '';
	}

	public function aRHidden($idResponsable)
	{
		if($this->responsables()->find($idResponsable))
			return '';
		return 'hidden';
	}

	public function aCHidden($idColaborador)
	{
		if($this->colaboradores()->find($idColaborador))
			return '';
		return 'hidden';
	}

	public function AR($idResponsable)
	{
		if($this->responsables()->find($idResponsable))
		{
			return $this->responsables()->find($idResponsable)->aclaracion;
		}
		return '';
	}

	public function AC($idColaborador)
	{
		if($this->colaboradores()->find($idColaborador))
		{
			return $this->colaboradores()->find($idColaborador)->aclaracion;
		}
		return '';
	}

	public function getNovedad()
	{
		if($this->novedad)
			return 'checked="checked"';
		return '';
	}
	*/

}
?>