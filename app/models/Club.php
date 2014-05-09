<?php

use Magniloquent\Magniloquent\Magniloquent;

class Club extends Magniloquent {
	protected $guarded = array('id');

	protected $fillable = array('season_id', 'grade_id', 'name', 'state');

	public static $rules = array(
		"save" => array(
			'name' => 'required',
			'state' => 'required',
			'season_id' => 'required|numeric',
			'grade_id' => 'required|numeric'
		),
		"create" => array(
			'name' => 'required',
			'state' => 'required',
			'season_id' => 'required|numeric',
			'grade_id' => 'required|numeric'
		),
		"update" => array()
	);

	protected static $relationships = array(
		'region' => array('belongsTo', 'Season', 'season_id'),
		'grade' => array('belongsTo', 'Grade', 'grade_id')
	);

	/**
	 * @param $query
	 * @param $name
	 * @return mixed
	 */
	public function scopeName($query, $name)
	{
		return $query->where('name', '=', $name);
	}

	/**
	 * @param $query
	 * @param $season_id
	 * @return mixed
	 */
	public function scopeSeason($query, $season_id)
	{
		return $query->where('season_id', '=', $season_id);
	}

	/**
	 * @param $query
	 * @param $grade_id
	 * @return mixed
	 */
	public function scopeGrade($query, $grade_id)
	{
		return $query->where('grade_id', '=', $grade_id);
	}

	/**
	 * @param $query
	 * @param $status
	 */
	public function scopeActive($query, $status ){
		return $query->where('active', '=', $status);
	}
}
