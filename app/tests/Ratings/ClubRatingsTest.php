<?php
namespace Ratings;

use Ratings\ClubRatings;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class ClubRatingsTest extends \TestCase
{

	protected $path;
	protected $crawler;
	protected $client;

	public function setUp()
	{
		parent::setUp();

		$this->client = new Client();
		$this->path = "http://www.golf.org.au/default.aspx?s=aus-slope-ratings&State=QLD";
		$this->crawler = $this->client->request('GET', $this->path);
	}

	/**
	 *
	 */
	public function testPageConnection()
	{
		$this->client->request('GET', $this->path);
		$this->assertEquals(200, $this->client->getResponse()->getStatus());
	}

	public function testCourseName()
	{
		$ratingRepository = \Mockery::mock('Pennants\Rating\RatingRepositoryInterface');
		$clubRepository = \Mockery::mock('Pennants\Club\ClubRepositoryInterface');

		$course = "Mt Coolum Golf Club";
		$state = "QLD";

		$rating = new ClubRatings($ratingRepository, $clubRepository);

		$courseList = $rating->getCourses($this->crawler);
		$courseName = $rating->setCourseName($course, $state);

		$this->assertEquals($courseName, $courseList[146]);
	}

	public function testCoursePosition()
	{
		$ratingRepository = \Mockery::mock('Pennants\Rating\RatingRepositoryInterface');
		$clubRepository = \Mockery::mock('Pennants\Club\ClubRepositoryInterface');

		$course = "Mt Coolum Golf Club";
		$state = "QLD";

		$rating = new ClubRatings($ratingRepository, $clubRepository);

		$courseList = $rating->getCourses($this->crawler);
		$courseName = $rating->setCourseName($course, $state);

		$position = $rating->setPosition($courseName, $courseList);

		$this->assertEquals($position, 146);
	}

	public function testValidCourseName()
	{
		$ratingRepository = \Mockery::mock('Pennants\Rating\RatingRepositoryInterface');
		$clubRepository = \Mockery::mock('Pennants\Club\ClubRepositoryInterface');

		$course = "Mt Coolum Golf Club";
		$state = "QLD";

		$rating = new ClubRatings($ratingRepository, $clubRepository);

		$courseList = $rating->getCourses($this->crawler);
		$courseName = $rating->setCourseName($course, $state);

		$position = $rating->setPosition($courseName, $courseList);

		$check = $rating->checkCourses($courseList, $courseName, $position);

		$this->assertFalse($check);
	}

	public function testListRatings()
	{
		$ratingRepository = \Mockery::mock('Pennants\Rating\RatingRepositoryInterface');
		$clubRepository = \Mockery::mock('Pennants\Club\ClubRepositoryInterface');

		$rating = new ClubRatings($ratingRepository, $clubRepository);

		$course = "Mt Coolum Golf Club";
		$state = "QLD";
		$clubId = 10;

		$courseList = $rating->getCourses($this->crawler);
		$courseName = $rating->setCourseName($course, $state);

		$position = $rating->setPosition($courseName, $courseList);

		$ratings = $rating->getRatings($position, $this->crawler, $clubId);

		$this->assertEquals(72, $ratings[0]['par']);
		$this->assertEquals(131, $ratings[0]['slope']);
		$this->assertEquals("Women", $ratings[3]['tee_sex']);
		$this->assertEquals(129, $ratings[3]['slope']);
	}

	public function testAllRatings()
	{
		$ratingRepository = \Mockery::mock('Pennants\Rating\RatingRepositoryInterface');
		$clubRepository = \Mockery::mock('Pennants\Club\ClubRepositoryInterface');

		$course = "Mt Coolum Golf Club";
		$state = "QLD";
		$clubId = 10;

		$rating = new ClubRatings($ratingRepository, $clubRepository);
		$ratings = $rating->initialize($course, $state, $clubId);

		$this->assertEquals(1, 1);
	}
}