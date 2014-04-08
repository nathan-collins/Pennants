<?php

use Fbf\LaravelBlog\Category;

class Post extends Fbf\LaravelBlog\Post {
	/**
	 * Defines the belongsToMany relationship between Post and Category
	 *
	 * @return mixed
	 */
	public function categories()
	{
		return $this->belongsToMany('Fbf\LaravelCategories\Category', 'category_post');
	}

	/**
	 * Query scope to filter posts by a given category
	 *
	 * @param $query
	 * @param $categorySlug
	 * @throws InvalidArgumentException
	 * @return mixed
	 */
	public function scopeByRelationship($query, $categorySlug)
	{
		$category = Category::live()
			->where('slug', '=', $categorySlug)
			->first();

		if (!$category)
		{
			throw new InvalidArgumentException('Category not found');
		}

		return $query->join('category_post', $this->getTable().'.id', '=', 'category_post.post_id')
			->join('fbf_categories', 'category_post.category_id', '=', 'fbf_categories.id')
			->whereBetween('fbf_categories.lft', array($category->lft, $category->rgt))
			->groupBy($this->getTable().'.id');
	}
}