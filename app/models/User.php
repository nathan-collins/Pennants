<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Magniloquent\Magniloquent\Magniloquent;

class User extends Magniloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * Mark as deleted
	 *
	 * @var bool
	 */

	protected $fillable = array('username', 'firstname', 'lastname', 'password', 'email');

	protected $softDelete = true;

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * @var array
	 */

	public static $rules = array(
		"save" => array(
			'username' => 'required',
			'password' => 'required',
			'email'	=> 'required|email'
		),
		"create" => array(),
		"update" => array()
	);

	public static $factory = array(
		'username' => 'string',
		'password' => 'password',
		'email' => 'email'
	);

	protected static $relationship = array(
		'seasons' => array('hasMany', 'Season')
	);

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

}