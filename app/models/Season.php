<?php

use Magniloquent\Magniloquent\Magniloquent;

class Season extends Magniloquent {

	protected $table = "seasons";

	/**
	 * Properties that can be mass assigned
	 *
	 * @var array
	 */

	protected $fillable = array('name', 'year');

	/**
	 * Validation rules
	 *
	 * @var array
	 */

	public static $rules = array(
		"save" => array(
			'name' => 'required',
			'year' => 'required|numeric'
		),
		"create" => array(),
		"update" => array()
	);

	/**
	 * Factory settings
	 *
	 * @var array
	 */

	public static $factory = array(
		'name' => 'string',
		'year' => 'string',
		'added_by' => 'factory|User'
	);

	/**
	 * @var array
	 */

	protected static $relationship = array(
		'user' => array('belongsTo', 'User', 'added_by')
	);
}
