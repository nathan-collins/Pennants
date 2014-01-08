<?php

use Magniloquent\Magniloquent\Magniloquent;

class PlayerResult extends Magniloquent {
	protected $guarded = array('id');

	public static $rules = array();
}
