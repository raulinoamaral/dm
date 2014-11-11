<?php 
class Categoria extends  Eloquent 
{
	protected $table = 'categoria';

	public static $sluggable = array(
        'build_from' => 'nombre',
        'save_to'    => 'slug',
    );

	public function proyectos()
	{
		return $this->hasMany('Proyecto');
	}

    public function getLink()
    {
    	return asset('portafolio/'.$this->slug);
    }

}
?>