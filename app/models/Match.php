<?php

use Magniloquent\Magniloquent\Magniloquent;

class Match extends Magniloquent {
	protected $guarded = array('id');

	protected $fillable = array('season_id', 'grade_id');
}
