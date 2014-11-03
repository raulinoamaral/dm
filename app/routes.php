<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@showIndex');

Route::get('/portafolio', 'HomeController@showPortafolio');

Route::get('/ficha', 'HomeController@showFicha');

Route::get('/contacto', 'HomeController@showContacto');


//
Route::get('admin/login', array('before' => 'guest', 'uses' =>'AuthController@getLogin'));
Route::get('admin/recuperar-clave', array('before' => 'guest', 'uses' =>'RemindersController@getRemind'));
Route::post('admin/enviar-clave', 'RemindersController@postRemind');
Route::get('password/reset/{token}', 'RemindersController@getReset');
Route::post('admin/guardar-clave', 'RemindersController@postReset');
Route::post('autenticar', 'AuthController@postLogin');
Route::get('cerrarSesion', 'AuthController@getLogout');

Route::get('reminder', function()
	{	
		return View::make('emails.reminder-prueba', array('nombre' => 'Pedro', 'mail' => 'juan@gmail.com', 'telefono' => '099872101', 'mensaje' => 'I felt in love with computers when I was 7, now Im 29 and I still love Pokemon..but this is another story! Im a passionate Designer, an unimpeachable Developer and an unstoppable Dreamer (now you know why my site has three ds at the end *sigh of wonder*). Im always looking for the good side of life, I love to learn new things and if you want to make me happy, create a challenge for me.'));
	});


//Seguridad CSRF para formularios
//Route::when('*', 'csrf', array('post', 'put', 'delete'));


//Routes de la API pública para AngularJS
Route::group(array('prefix'=>'/api'),function(){
 
});



//Routes agrupados que requieren autenticación

Route::group(array('before' => 'auth'), function()
{
	Route::get('admin', 'AdminController@showIndex');
	//Route::get('admin/configuracion', 'AdminController@showConfig');
	//Route::post('admin/cambiarClave', 'AuthController@updateClave');

	Route::get('admin/proyectos/nuevo', 'ProyectoController@create');
	Route::post('admin/proyectos/guardar', 'ProyectoController@store');
	Route::post('admin/proyectos/ordenar', 'ProyectoController@ordenar');
	Route::get('admin/proyectos/{id}/editar', 'ProyectoController@edit');
	Route::post('admin/proyectos/{id}/actualizar', 'ProyectoController@update');
	Route::post('admin/proyecto/eliminar', 'ProyectoController@destroy');
	Route::get('admin/proyectos/{id}/galeria', 'ProyectoController@gallery');
	Route::post('admin/proyectos/{id}/galeria/cargarImagenes', 'ProyectoController@cargarImagenes');
	Route::post('admin/imagenes/ordenar', 'ImagenController@update');
	Route::post('admin/imagenes/eliminar', 'ImagenController@destroy');
	Route::post('admin/imagenes/eliminarTodas', 'ProyectoController@eliminarImagenes');		
});
