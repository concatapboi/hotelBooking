<?php

//Start routes Frontend
Route::group(['prefix'=>''],function(){

	Route::get('/',[
		'as' => 'home',
		'uses' => 'Frontend\PageController@index'
	]);

	Route::get('/blog.html',[
		'as' => 'blog',
		'uses' => 'Frontend\PageController@blog'
	]);

	Route::get('/single-blog.html',[
		'as' => 'blog',
		'uses' => 'Frontend\PageController@singleBlog'
	]);

	Route::get('/about.html',[
		'as' => 'about',
		'uses' => 'Frontend\PageController@about'
	]);

	Route::get('/contact.html',[
		'as' => 'contact',
		'uses' => 'Frontend\PageController@contact'
	]);

	Route::get('/customer.html',[
		'as' => 'customer',
		'uses' => 'Frontend\CustomerController@index'
	]);

	Route::get('/login.html',[
		'as' => 'login',
		'uses' => 'Frontend\PageController@login'
	]);

	Route::post('/post-login.html',[
		'as' => 'postLogin',
		'uses' => 'Frontend\PageController@postLogin'
	]);

	Route::get('/register.html',[
		'as' => 'register',
		'uses' => 'Frontend\PageController@register'
	]);

	Route::post('/post-register.html',[
		'as' => 'postRegister',
		'uses' => 'Frontend\PageController@postRegister'
	]);

	Route::get('/logout.html',[
		'as' => 'logout',
		'uses' => 'Frontend\CustomerController@logout'
	]);

	Route::get('/profile.html',[
		'as' => 'profile',
		'uses' => 'Frontend\CustomerController@profile'
	]);

	Route::group(['prefix'=>'user/'],function(){

		Route::get('/',[
			'as' => 'user',
			'uses' => 'Frontend\PageController@index'
		]);

		Route::get('/{id}',[
			'as' => 'user',
			'uses' => 'Frontend\PageController@user'
		]);

		Route::post('/following/{id}',[
			'as' => 'following',
			'uses' => 'Frontend\CustomerController@followUser'
		]);

		Route::post('/unfollowing/{id}',[
			'as' => 'un-following',
			'uses' => 'Frontend\CustomerController@unfollowUser'
		]);

	});

	Route::group(['prefix'=>'hotel/'],function(){

		Route::get('/all-hotels.html',[
			'as' => 'allHotels',
			'uses' => 'Frontend\PageController@allHotels'
		]);

		Route::get('/{id}',[
			'as' => 'hotelInfo',
			'uses' => 'Frontend\PageController@hotelInfo'
		]);

		Route::post('/following/{id}',[
			'as' => 'hotel-following',
			'uses' => 'Frontend\CustomerController@followHotel'
		]);

		Route::post('/unfollowing/{id}',[
			'as' => 'hotel-unfollowing',
			'uses' => 'Frontend\CustomerController@unfollowHotel'
		]);

	});

});
//End routes Frontend
