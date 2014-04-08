<?php

class PennantsController extends BaseController
{
	public function showIndex()
	{
		return View::make('pennants.index');
	}
}