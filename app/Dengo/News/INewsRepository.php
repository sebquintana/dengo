<?php namespace Dengo\News;

use Dengo\News\News;

interface INewsRepository {
	
	public function getNewsArrayById($trendingNewsArray);

	public function getLatestsNews();

	public function findById($id);

	public function save(News $news);

	public function getSearchNews();

	public function all();
}