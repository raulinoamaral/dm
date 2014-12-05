<?php 
class SlugProyecto extends  Eloquent 
{
	protected $table = 'slug_viejo_proyecto';

	public function proyecto()
	{
		return $this->belongsTo('Proyecto');
	}
}
?>