<?php

class NewsController extends \BaseController {

	public function searchNewsByKeyWord($keywordsStringForDBSearch){

		return News::whereRaw("MATCH(title,resume) AGAINST(? IN BOOLEAN MODE)"),array($keywordsStringForDBSearch))->get();
	}
}