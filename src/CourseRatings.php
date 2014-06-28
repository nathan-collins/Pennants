<?php

class CourseRatings implements Countable
{
	 	protected $collection;

    public function add($rating)
    {

			if(is_array($rating)) {
				return array_map(array($this, 'add'), $rating);
			}

			$this->collection[] = $rating;
    }

		public function count()
		{
			return count($this->collection);
		}


}
