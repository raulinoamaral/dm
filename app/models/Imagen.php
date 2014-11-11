<?php 
class Imagen extends  Eloquent 
{
	protected $table = 'imagen';

	public function proyecto()
    {
        return $this->belongsTo('Proyecto');
    }

    public function getMinSrc()
    {
        return asset($this->ruta.'min/'.$this->nombre_archivo);
    }

    public function getBigSrc()
    {
        return asset($this->ruta.'big/'.$this->nombre_archivo);
    }

    public function getPdaSrc()
    {
        return asset($this->ruta.'pda/'.$this->nombre_archivo);
    }

}
?>