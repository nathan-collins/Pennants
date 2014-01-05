<?php

use Magniloquent\Magniloquent\Magniloquent;

class Seasons extends Magniloquent {
	protected $guarded = array('id');

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
	);
}
