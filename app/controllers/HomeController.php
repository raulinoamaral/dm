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

	public function show()
	{
		$title = 'Decarlini Maside Arquitectura y Dise&ntilde;o - Rocha, Uruguay';
		$meta_description = '';
		return View::make('web.index', array('title' => $title, 'meta_description' => $meta_description));
	}

}
