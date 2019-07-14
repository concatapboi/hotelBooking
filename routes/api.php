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
Route::group(['prefix' => '/manager'], function () {
    Route::post('login', 'Backend\AuthController@login');
    Route::post('register', 'Backend\AuthController@register');
    Route::post('country', 'Backend\AddressController@postCountries');
    Route::get('searching', 'Backend\HotelController@search');
    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::post('logout', 'Backend\AuthController@logout');
        Route::resource('hotel', 'Backend\HotelController');
        Route::resource('room', 'Backend\RoomController');
        Route::get('all-room', 'Backend\RoomController@getAllRoomByHotelId');
        Route::resource('hotel-type', 'Backend\HotelTypeController');
        Route::resource('service', 'Backend\ServiceController');
        Route::post('add-service', 'Backend\HotelController@addService');
        Route::delete('remove-service-room', 'Backend\HotelController@removeServiceRoom');
        Route::post('add-all-service', 'Backend\HotelController@addAllRoom');
        Route::post('add-service-room', 'Backend\HotelController@addServiceRoom');
        Route::post('add-feature', 'Backend\FeatureController@addFeature');
        Route::delete('remove-feature-room', 'Backend\FeatureController@removeFeatureRoom');
        Route::post('add-all-feature', 'Backend\FeatureController@addAllRoom');
        Route::post('add-feature-room', 'Backend\FeatureController@addFeatureRoom');
        Route::resource('feature', 'Backend\FeatureController');
        Route::resource('booking', 'Backend\BookingController');
        Route::get('all-booking', 'Backend\BookingController@getBookingWithHotelId');
        Route::post('accept', 'Backend\BookingController@acceptBooking');
        Route::post('decline', 'Backend\BookingController@declineBooking');
        Route::post('confirm', 'Backend\BookingController@confirmBooking');
        Route::post('cancel', 'Backend\BookingController@cancelBooking');
        Route::get('hotel-address', 'Backend\AddressController@getAddress');
        Route::get('province', 'Backend\AddressController@getProvince');
        Route::get('district', 'Backend\AddressController@getDistrict');
        Route::get('ward', 'Backend\AddressController@getWard');
        Route::Resource('room-mode', 'Backend\RoomModeController');
        Route::Resource('room-type', 'Backend\RoomTypeController');
        Route::get('room-types', 'Backend\HotelController@getAllRoomType');
        Route::Resource('bed-type', 'Backend\BedTypeController');
    });
});

Route::resource('/hotel', 'Frontend\HotelController');
Route::get('/get-top5-hotel', 'Frontend\HotelController@getTop5');
Route::resource('/user', 'Frontend\UserController');
Route::get('/get-top5-user', 'Frontend\UserController@getTop5');
Route::get('/check-user', 'Frontend\UserController@checkUser');
Route::get('/member-count', 'Frontend\UserController@getMemberCount');
Route::get('/check-password', 'Frontend\UserController@checkUserPassword');
Route::get('/update-password', 'Frontend\UserController@updateUserPassword');
Route::resource('/image', 'Frontend\UserImageController');
Route::resource('/payment-method', 'Frontend\PaymentMethodController');
Route::post('/login', 'Frontend\AuthController@postLogin');
Route::get('/check', 'Frontend\AuthController@check');
Route::post('/register', 'Frontend\AuthController@postRegister');
Route::get('district', 'Backend\AddressController@getDistrictByPronvinceName');
Route::get('service', 'Backend\ServiceController@getAllService');
Route::get('hotel-type', 'Backend\HotelTypeController@getAllHotelType');
Route::get('room-type', 'Backend\RoomTypeController@getAllRoomType');
Route::group(['middleware' => 'jwt.auth'], function () {
    Route::post('/logout', 'Frontend\AuthController@postLogout');
    Route::get('/getUserLogin', 'Frontend\AuthController@getUserLogin');
    Route::get('/getUser', 'Frontend\UserController@getUser');
    Route::get('/userInfo', 'Frontend\UserController@getUserInfo');
    Route::resource('/booking', 'Frontend\BookingController');
    Route::resource('/review', 'Frontend\ReviewController');
    Route::resource('/question', 'Frontend\QuestionController');
    Route::resource('/comment', 'Frontend\QuestionController');
    Route::get('/following', 'Frontend\UserController@follow');
    Route::get('/un-following', 'Frontend\UserController@unfollow');
    Route::get('/like', 'Frontend\CustomerReviewController@like');
    Route::get('/get-notification', 'Frontend\CustomerReviewController@getNotification');
    Route::get('/update-useful', 'Frontend\CustomerReviewController@updateUseful');
});
