<?php

use Magniloquent\Magniloquent\Magniloquent;

class Season extends Magniloquent {

	protected $table = "seasons";

	/**
	 * Properties that can be mass assigned
	 *
	 * @var array
	 */

	protected $fillable = array('year', 'competition_id');

	/**
	 * Validation rules
	 *
	 * @var array
	 */

	public static $rules = array(
		"save" => array(
			'year' => 'required|numeric',
			'competition_id' => 'numeric'
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
		'year' => 'string',
		'competition_id' => 'factory|Competition',
		'added_by' => 'factory|User'
	);

	/**
	 * @var array
	 */

	protected static $relationships = array(
		'competition' => array('belongsTo', 'Competition'),
		'user' => array('belongsTo', 'User', 'added_by')
	);

	/**
	 * @param $query
	 * @param $alias
	 * @param $year
	 * @return mixed
	 */

	public function scopeGetSeasonId($query, $alias, $year)
	{
		$season = $query->select('seasons.id AS seasonId');
			$query->leftJoin('competitions', 'seasons.competition_id', '=', 'competitions.id');
			$query->where('alias', $alias);
			$query->where('year', $year);
		return $season->first();
	}
}
