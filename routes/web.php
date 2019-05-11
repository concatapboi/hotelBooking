<?php

//Start routes Frontend


Route::group(['prefix' => '/manager'], function(){
    Route::get('/', 'PageController@managerIndex');
	Route::get('/{string}', 'PageController@managerIndex')->where('string','.*');
});

Route::group(['prefix' => '/admin'], function(){
    Route::get('/', 'PageController@adminIndex');
	Route::get('/{string}', 'PageController@adminIndex')->where('string','.*');
});

Route::group(['prefix' => ''], function(){
    Route::get('/', 'PageController@index');
	Route::get('/{string}', 'PageController@redirect')->where('string','.*');
});
