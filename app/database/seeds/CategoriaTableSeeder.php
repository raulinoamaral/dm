<?php 
class CategoriaTableSeeder extends Seeder {

    public function run()
    {
        DB::table('categoria')->delete();

        Categoria::create(array(
            'nombre'        =>  'Complejos',
            'slug'          =>  'complejos',
            'descripcion'   =>  'Complejos diseñados por nuestro estudio.'
        	));
        Categoria::create(array(
            'nombre'        =>  'Viviendas familiares',
            'slug'          =>  'viviendas-familiares',
            'descripcion'   =>  'Viviendas diseñadas y planificadas por nuestro estudio.'
            ));
        Categoria::create(array(
            'nombre'        =>  'Reforma de viviendas',
            'slug'          =>  'reforma-de-viviendas',
            'descripcion'   =>  'Reformas que hemos desarrollado sobre viviendas pre existentes.'  
            ));
    }
}
?>