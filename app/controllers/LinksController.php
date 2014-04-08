<?php

class LinksController extends BaseController
{
	public function showIndex()
	{
		return View::make('links.index');
	}
}