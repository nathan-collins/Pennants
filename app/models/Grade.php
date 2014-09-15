<?php

use Magniloquent\Magniloquent\Magniloquent;

class Grade extends Magniloquent {
	protected $guarded = array('id');

	protected $fillable = array('name', 'season_id', 'added_by', 'settings');

	public static $rules = array(
		"save" => array(
			'name' => 'required'
		),
		"create" => array(),
		"update" => array()
	);

	/**
	 * Relationships to model
	 *
	 * @var array
	 */

	protected static $relationships = array(
		'season' => array('belongsTo', 'Season', 'season_id'),
		'user' => array('belongsTo', 'User', 'added_by')
	);

	/**
	 * Factory settings
	 *
	 * @var array
	 */

	public static $factory = array(
		'name' => 'string',
		'season_id' => 'factory|Season',
		'added_by' => 'factory|User'
	);

	public function scopeGetByGrade($query, $grade_id)
	{
		$query->where('grades.id', '=', $grade_id) ;
	}

	/**
	 * @param $query
	 * @param $season_id
	 */
	public function scopeGetBySeason($query, $season_id)
	{
	 	$query->where('grades.season_id', '=', $season_id);
	}
}
