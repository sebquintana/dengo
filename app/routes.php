<?php
//Route::get('/', 'HomeController@index');

//Route::get('/index', function(){
//
//	return View::make('index-old');
//});

Route::resource('/', 'HomeController');
//Route::resource('/sources', 'SourceController@index');

//Route::resource('/sources/{Name}', 'SourceController@show');

//Route::resource('/search/{keyword}', 'HomeController@show' );
Route::resource('/{keyword}', 'HomeController@show' );

