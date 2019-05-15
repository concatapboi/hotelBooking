<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->all();
// });
Route::group(['prefix' => '/manager'], function(){
    Route::post('login','Backend\AuthController@login');
    Route::post('register','Backend\AuthController@register');
});

Route::resource('/hotel', 'Frontend\HotelController');
Route::resource('/user', 'Frontend\UserController');
Route::post('/login','Frontend\AuthController@postLogin');
Route::get('/getUserLogin','Frontend\AuthController@getUserLogin');
Route::get('/getLogout','Frontend\AuthController@getLogout');
Route::get('/check','Frontend\AuthController@check');
Route::post('/register','Frontend\AuthController@postRegister');