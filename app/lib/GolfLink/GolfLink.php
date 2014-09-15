<?php

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class GolfLink {

	public function __construct()
	{
		$this->path = "http://www.golflink.com.au/handicap-history/?golflink_No=";
		$this->client = new Client();
	}

	/**
	 * @param $golfLinkNumber
	 * @return Crawler
	 */
	public function initialize($golfLinkNumber)
	{
		if(isset($golfLinkNumber)) {
			$path = $this->setPath($golfLinkNumber);
			$crawler = $this->connection($path);
			return $crawler;
		}
	}

	/**
	 * @param $crawler
	 * @return mixed
	 */
	public function getGolfLinkNumber($crawler)
	{
		$golfLinkNumber = $crawler->filter('section.handicap-head2 span.gl-no')->text();
		return $golfLinkNumber;
	}

	public function retrieveDateHandicap($crawler, $position)
	{
		$handicap = $crawler->filter('#history-body .trow')->eq($position)->nextAll()->each(function($node) {
			return $node->filter('.for-mobi-layout .new-hc span.cv')->text();
		});

		return abs($handicap[0]);
	}

	/**
	 * @param $golfLinkNumbers
	 */
	public function getBatchHandicap($golfLinkNumbers)
	{
		foreach($golfLinkNumbers as $golfLinkNumber)
		{
			$this->initialize($golfLinkNumber);
		}
	}

	/**
	 * @param $path
	 * @return Crawler
	 */
	protected function connection($path)
	{
		$crawler = $this->client->request('GET', $path);
		return $crawler;
	}

	public function setPath($golfLinkNumber)
	{
		$path = $this->path.$golfLinkNumber."&orderBy=6";
		return $path;
	}

	/**
	 * @param $crawler
	 * @return string
	 */
	public function getHandicap($crawler)
	{
		$handicap = $crawler->filter('div.calc-handicap-container span')->text();
		return $handicap;
	}

	public function getDates($crawler)
	{
		$filteredResults = array();

		$dates = $crawler->filter('div#history-body .c2 a')->each(function($node) {
			return $node->text();
		});

		foreach($dates as $date) {
			$filteredResults[] = $this->seperateDate($date);
		}

		return $filteredResults;
	}

	public function getAnchor($crawler)
	{
		$anchor = $crawler->filter('section.cap-reg-section .cr strong')->text();
		return abs($anchor);
	}

	public function getAnchorDate($crawler)
	{
		$anchorLine = $crawler->filter('section.cap-reg-section .cr')->text();
		$gatherResults = explode(" ", $anchorLine);
		$filterResults = array_values(array_filter($gatherResults));

		$anchorDate = array_pop($filterResults);
		$anchorDate = str_replace("\r\n", "", $anchorDate);
		return $anchorDate;
	}

	public function seperateDate($date)
	{
		$date = explode(",", $date);
		return $date[0];
	}

	public function getNearestDate($dates, $searchDate)
	{
		$date = new DateTime($searchDate);
		$searchDate = $date->format("d/m/Y");

		$searchDate = DateTime::createFromFormat('d/m/Y', $searchDate);
		$position = 0;
		foreach($dates as $date) {
			$date = DateTime::createFromFormat('d/m/Y', $date);
			$searchDateInterval = $searchDate->format("Y/m/d");
			$dateInterval = $date->format("Y/m/d");

			$difference = strtotime($searchDateInterval) - strtotime($dateInterval);

			if($difference > 0) {
				$interval[$position] = $difference;
			}
			$position++;
		}
		asort($interval);
		$closest = key($interval);

		return array('date' => $dates[$closest], 'interval' => $closest);
	}

	public function getHandicapByDate($crawler, $date)
	{
		$dates = $this->getDates($crawler);

		$closest = $this->getNearestDate($dates, $date);

		$handicap = $this->retrieveDateHandicap($crawler, $closest['interval']);

		return $handicap;
	}
}