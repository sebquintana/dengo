<?php

Route::get('/', [
	'as' => 'home',
	'uses' => 'TrendingNewsController@index'
]);

Route::post('search',[
	'as' => 'search_path',
	'uses' => 'SearchController@store'
]);

Route::get('@{title}', [
	'as' => 'trending_search_path',
	'uses' => 'SearchController@show'
]);

Route::get('about', [
	'as' => 'about_path',
	'uses' => 'AboutUsController@index'
]);