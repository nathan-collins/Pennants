<?php

class Ratings {
	protected $ratingsPath = "http://www.golf.org.au/default.aspx?s=aus-slope-ratings&State=";
	protected $state = "QLD";
	protected $courseName = '';
	public $filterWords = array('golf', 'course', 'country', 'club', 'inc');

	public function __construct($state, $ratingsPath, $courseName)
	{
		$this->state = $state;
		$this->ratingsPath = $ratingsPath;
		$this->courseName = preg_replace('/\s+/', '', strtolower($courseName));
	}

	/**
	 *
	 */

	protected function getRatings()
	{
		$client = new Goutte\Client();
		$crawler = $client->request('GET', $this->ratings_path.$this->state);
		$crawler->filter('tr.rowheader td a')->each(function($node) {
			$findCourse = explode(' ', strtolower($node->text));
			$course = explode(' ', strtolower($this->courseName));

			$result = array_diff($findCourse, $course);
		});
	}
}