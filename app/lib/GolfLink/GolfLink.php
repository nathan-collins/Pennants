<?php

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class GolfLInk {

	protected $number;

	public function __construct($number)
	{
		$this->number = $number;
		$this->path = "http://www.golflink.com.au/handicap-history/?golflink_no==";
	}

	/**
	 * @return Crawler
	 */

	protected function connection($client)
	{
		$path = $this->path.$this->number;
		$crawler = $client->request('GET', $path);
		return $crawler;
	}

	public function retrieveScores()
	{
		$client = new Client();
		$crawler = $this->connection($client);
		$link = $crawler->selectLink('Click here to continue to your handicap')->link();
		if($link) {
			$crawler = $client->click($link);
		}
		$crawler->filter('#ContentPage_glHandicapHistory_DgrHCHistory tr')->each(function ($node) {
			print $node->text()."\n";
		});
	}
}