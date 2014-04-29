<?php

Route::get('/about', function()
{
    return View::make('about');
});

Route::resource('/', 'HomeController');

Route::resource('{keyword}', 'HomeController@show' );
