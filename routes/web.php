<?php

//Start routes Frontend


Route::group(['prefix' => '/manager'], function(){
    Route::get('/', 'PageController@managerIndex');
    Route::get('/login', 'Backend\AuthController@managerLogin');
    Route::get('/register', 'Backend\AuthController@managerLogin');
	Route::get('/{string}', 'PageController@managerIndex')->where('string','.*');
});

Route::group(['prefix' => '/admin'], function(){
    Route::get('/', 'PageController@adminIndex');
    Route::get('/login', 'Backend\AuthController@managerLogin');
    Route::get('/register', 'Backend\AuthController@managerLogin');
	Route::get('/{string}', 'PageController@adminIndex')->where('string','.*');
});

Route::group(['prefix' => '/community'], function(){    
    Route::get('/', 'PageController@getCommunityPage');
    Route::get('/{string}', 'PageController@getCommunityPage')->where('string','.*'); 
});

Route::group(['prefix' => ''], function(){    
    Route::get('/', 'PageController@index');
    Route::get('/{string}', 'PageController@index')->where('string','.*'); 
});


