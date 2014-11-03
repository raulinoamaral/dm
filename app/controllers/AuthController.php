<?php 
class AuthController Extends BaseController
{
	public function getLogin()
	{
		$title = 'Iniciar sesi&oacute;n - Decarlini Maside Arquitectura y Dise&ntilde;o';
		return View::make('admin.auth.login', array('title' => $title));
	}

	public function postLogin()
	{
		$credentials = array(
				'username'=>Input::get('username'),
				'password'=>Input::get('password')
			);

		if(Auth::attempt($credentials))
		{
			return Redirect::to('admin');
		}
		else
		{
			return Redirect::back()->withInput();
		}
	}

	public function getLogout()
	{
		Auth::logout();
		return Redirect::to('admin');
	}

	public function nuevaClave()
	{
		return View::make('admin/usuario/nuevaClave')->with('title', 'Cambio de clave - Decarlini Maside Arquitectura y Dise&ntilde;o');
	}


	public function updateClave()
	{
		if(Request::ajax())
		{
			$user = Auth::user();
			$clave = Input::get('clave');
			$claveNueva = Input::get('claveNueva');
			$claveNuevaConfirmada = Input::get('claveNueva_confirmation');
			if(Hash::check($clave, $user->password))
			{
				$validator = User::validate(Input::only('claveNueva', 'claveNueva_confirmation'));
				if($validator->passes())
				{
					$user->password = Hash::make($claveNueva);
					$user->save();
					return Response::json(array(
						'ok' => true,
						'valida'    => true
						));
				}
				else
				{
					return Response::json(array(
						'ok' => true,
						'valida'	  => false
						));
				}
			}
			else
			{
				return Response::json(array(
						'ok' => false,
						'valida'    => false
						));
			}	
		}
	}
}