<?php

Route::get('/quienesSomos', function()
{
    return View::make('about');
});

Route::resource('/', 'HomeController');

Route::resource('{keyword}', 'HomeController@show' );
