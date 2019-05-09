<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

	Route::get('/vue',function(){
		return view('Frontend.vue');
	});

	Route::get('/test',function(){
		return ;
	});

	Route::get('/a',[
		'as' => 'home',
		'uses' => 'Frontend\PageController@index'
	]);

	Route::get('/home.html',[
		'as' => 'home',
		'uses' => 'PageController@index'
	]);

	Route::get('/about.html',[
		'as' => 'about',
		'uses' => 'PageController@about'
	]);

	Route::get('/contact.html',[
		'as' => 'contact',
		'uses' => 'PageController@contact'
	]);

	Route::get('/blog.html',[
		'as' => 'blog',
		'uses' => 'PageController@blog'
	]);

	Route::get('/all-hotels.html',[
		'as' => 'allHotels',
		'uses' => 'PageController@allHotels'
	]);
	Route::get('/hotel-info.html',[
		'as' => 'hotelInfo',
		'uses' => 'PageController@hotelInfo'
	]);

	Route::get('/single-blog.html',[
		'as' => 'singleBlog',
		'uses' => 'PageController@singleBlog'
	]);

	Route::get('/register.html',[
		'as

		' => 'register',
		'uses' => 'PageController@register'
	]);

	Route::get('/login.html',[
		'as' => 'login',
		'uses' => 'PageController@register'
	]);

	Route::post('/login',[
		'as' => 'postLogin',
		'uses' => 'PageController@postLogin'
	]);

	Route::post('/following',[
		'as' => 'follow',
		'uses' => 'PageController@alert'
	]);

	Route::get('/customer',[
		'as' => 'customer',
		'uses' => 'CustomerController@index'
	]);

	Route::get('/logout.html',[
		'as' => 'logout',
		'uses' => 'CustomerController@logout'
	]);

	Route::get('/abc',function(){
		dd(Auth::user());
	});

//////////////////////////////////////////////////////
// Route::get('/a',[
// 	'as' => 'home',
// 	'uses' => 'AdminController@index'
// ]);

Route::get('/test.html',[
	'as' => 'test',
	'uses' => 'AdminController@test'
]);

Route::get('/login.html',[
	'as' => 'login',
	'uses' => 'PageController@login'
]);

Route::post('/login.html',[
	'as' => 'postlogin',
	'uses' => 'PageController@postLogin'
]);

Route::get('/logout.html',[
	'as' => 'logout',
	'uses' => 'AdminController@logout'
]);

Route::get('/abc',function(){
	dd(Auth::guard('admin')->user());
});

Route::group(['prefix'=>'/manager'],function(){
	Route::get('/',[
		'as' => 'manager-home',
		'uses' => 'ManagerController@index'
	]);

	Route::get('/test.html',[
		'as' => 'manger-test',
		'uses' => 'ManagerController@test'
	]);

	Route::get('/login.html',[
		'as' => 'manager-login',
		'uses' => 'PageController@login'
	]);

	Route::post('/login.html',[
		'as' => 'manager-postlogin',
		'uses' => 'PageController@postLogin'
	]);

	Route::get('/logout.html',[
		'as' => 'manager-logout',
		'uses' => 'ManagerController@logout'
	]);

	Route::get('/abc',function(){
		dd(Auth::guard('manager')->user());
	});
});

///////////////////////////////////////////////////////////////////////
