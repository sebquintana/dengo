<?php namespace Dengo\News;

use Dengo\News\News;
use Dengo\Dates\DateManager;

class EloquentNewsRepository implements INewsRepository {
	
	public function getNewsArrayById($trendingNewsArray)
	{
		$newsArray = array();

		foreach ($trendingNewsArray as $trendingNews) {
			
			array_push($newsArray, News::find($trendingNews->id));
		}

		return $newsArray;
	}

	public function getLatestsNews()
	{
		return News::where('pubdate', '>=', DateManager::getDengoDateLimit())->get();
	}

	public function getSearchNews(){
        //return News::where('pubdate', '>=', DateManager::getSearchLimit());
       return $this->all();
    }

	public function findById($id)
	{
		return News::find($id);
	}

	public function find(News $news)
	{
		return $this->findById(md5($news->title . $news->resume));
	}	

	public function save(News $news)
	{
		$news->id = md5($news->title . $news->resume);
		$news->save();
	}

	public function all()
	{
		return News::all();
	}

}