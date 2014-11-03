<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showIndex()
	{
		$title = 'Decarlini Maside Arquitectura y Dise&ntilde;o - Rocha, Uruguay';
		$meta_description = '';
		return View::make('web.index', array('title' => $title, 'meta_description' => $meta_description));
	}

	public function showPortafolio()
	{
		$title = 'Decarlini Maside Arquitectura y Dise&ntilde;o - Rocha, Uruguay';
		$meta_description = '';
		return View::make('web.portafolio', array('title' => $title, 'meta_description' => $meta_description));
	}

	public function showFicha()
	{
		$title = 'Decarlini Maside Arquitectura y Dise&ntilde;o - Rocha, Uruguay';
		$meta_description = '';
		return View::make('web.ficha', array('title' => $title, 'meta_description' => $meta_description));
	}

	public function showContacto()
	{
		$title = 'Decarlini Maside Arquitectura y Dise&ntilde;o - Rocha, Uruguay';
		$meta_description = '';
		return View::make('web.contacto', array('title' => $title, 'meta_description' => $meta_description));
	}

	public static function sitemap()
	{
		$sitemap = App::make('sitemap');
		$sitemap->add('http://decarlinimaside.com', null, '1.0', 'weekly');
		$sitemap->add('http://bgarquitectos.com/portafolio', null, '1.0', 'weekly');
		$sitemap->add('http://bgarquitectos.com/estudio', null, '0.6', 'weekly');
		$sitemap->add('http://bgarquitectos.com/estudio', null, '0.6', 'weekly');
		$sitemap->add('http://bgarquitectos.com.uy/', null, '0.4', 'weekly');
		foreach(Proyecto::all() as $proyecto)
		{
			$sitemap->add($proyecto->getLink(), null, '1.0', 'weekly');
		}
		foreach(Categoria::all() as $categoria)
		{
			$sitemap->add($categoria->getLink(), null, '0.8', 'weekly');
		}
		$sitemap->store('xml', 'sitemap');
	}

}
