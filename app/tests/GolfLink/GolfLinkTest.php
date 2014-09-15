<?php
namespace GolfLink;

use Goutte\Client;
use GolfLink;

class GolfLinkTest extends \TestCase
{
	protected $path;
	protected $crawler;
	protected $client;

	public function setUp()
	{
		parent::setUp();

		$this->client = new Client();
	}

	/**
	 *
	 */
	public function testPageConnection()
	{
		$golfLink = new GolfLink();
		$golfLinkNumber = "4131602203";
		$path = $golfLink->setPath($golfLinkNumber);
		$this->client->request('GET', $path);
		$this->assertEquals(200, $this->client->getResponse()->getStatus());
	}

	public function testSingleHandicap()
	{
		$golfLink = new GolfLink();
		$golfLinkNumber = "4131602203";
		$handicap = $golfLink->getHandicap($golfLinkNumber);

		$this->assertNotNull($handicap);
	}

	public function testGolfLinkNumberMatches()
	{
		$golfLink = new GolfLink();
		$golfLinkNumber = "4131602203";
		$crawler = $golfLink->initialize($golfLinkNumber);
		$number = $golfLink->getGolfLinkNumber($crawler);

		$this->assertEquals($golfLinkNumber, $number);
	}

	public function testGolfLinkDates()
	{
		$golfLink = new GolfLink();
		$golfLinkNumber = "4131602203";
		$crawler = $golfLink->initialize($golfLinkNumber);
		$dates = $golfLink->getDates($crawler);

		$this->assertArrayHasKey(20, $dates);
	}

	public function testSearchByDate()
	{
		$golfLink = new GolfLink();
		$golfLinkNumber = "4131602203";
		$date = "06/06/2014";
		$crawler = $golfLink->initialize($golfLinkNumber);
		$dates = $golfLink->getDates($crawler);

		$closest = $golfLink->getNearestDate($dates, $date);

		$this->assertEquals("31/05/2014", $closest['date']);
	}

	public function testGetHandicapByDate()
	{
		$golfLink = new GolfLink();
		$golfLinkNumber = "4131602203";
		$date = "06/06/2014";
		$crawler = $golfLink->initialize($golfLinkNumber);
		$dates = $golfLink->getDates($crawler);

		$closest = $golfLink->getNearestDate($dates, $date);

		$handicap = $golfLink->retrieveDateHandicap($crawler, $closest['interval']);

		$this->assertEquals($handicap, 13.7);
	}

	public function testAnchorDate()
	{
		$golfLink = new GolfLink();
		$golfLinkNumber = "4131602203";
		$crawler = $golfLink->initialize($golfLinkNumber);
		$anchorDate = $golfLink->getAnchorDate($crawler);
		$anchorDate = \DateTime::createFromFormat('d/m/Y', $anchorDate);

		$anchorDateMonth = $anchorDate->format("m");
		$anchorDateYear = $anchorDate->format("Y");
		$anchorDateDay = $anchorDate->format("d");

		$this->assertTrue(checkdate($anchorDateMonth, $anchorDateDay, $anchorDateYear));
	}

	public function testSearchAndConvertByDate()
	{
		$golfLink = new GolfLink();
		$golfLinkNumber = "4131602203";
		$date = "06-06-2014";
		$crawler = $golfLink->initialize($golfLinkNumber);
		$dates = $golfLink->getDates($crawler);

		$closest = $golfLink->getNearestDate($dates, $date);

		$this->assertEquals("31/05/2014", $closest['date']);
	}
}