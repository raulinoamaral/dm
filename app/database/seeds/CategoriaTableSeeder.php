<?php 
class CategoriaTableSeeder extends Seeder {

    public function run()
    {
        DB::table('categoria')->delete();

        Categoria::create(array(
            'nombre'        =>  'Complejos',
            'slug'          =>  'complejos'
        	));
        Categoria::create(array(
            'nombre'        =>  'Viviendas familiares',
            'slug'          =>  'viviendas-familiares'
            ));
        Categoria::create(array(
            'nombre'        =>  'Reforma de viviendas',
            'slug'          =>  'reforma-de-viviendas'
            ));
    }
}
?>