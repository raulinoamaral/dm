<?php

class AdminController extends BaseController {

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
		$title = 'Panel de gesti&oacute;n - Decarlini Maside Arquitectura y Dise&ntilde;o';
		return View::make('admin.index', array('title' => $title))->with('proyectos', Proyecto::OrderBy('orden')->get());
	}
}
