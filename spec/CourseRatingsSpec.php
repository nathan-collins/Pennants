<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CourseRatingsSpec extends ObjectBehavior
{
	function it_is_initializable()
	{
			$this->shouldHaveType('CourseRatings');
	}

	function it_stores_a_collection_of_ratings_for_courses(\Rating $rating)
	{
		$this->add($rating);

		$this->shouldHaveCount(1);
	}

	function it_can_accept_multiple_ratings_at_once(\Rating $rating1, Rating $rating2)
	{
		$this->add(array($rating1, $rating2));

		$this->shouldHaveCount(2);
	}
}
