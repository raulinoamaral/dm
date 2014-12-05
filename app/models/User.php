<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user';

	public static $rules = array(
				'usuario.claveNueva' => 'required|max:150|confirmed'
			);

	public static $messages = array(
	            'claveNueva' => 'La clave nueva no es correcta.'
	        );

	public static function validate($data)
	{
		return Validator::make($data, static::$rules, static::$messages);
	}

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

}
