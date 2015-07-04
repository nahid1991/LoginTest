<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', 'WelcomeController@index');
//
//Route::get('home', 'HomeController@index');
//
//Route::controllers([
//	'auth' => 'Auth\AuthController',
//	'password' => 'Auth\PasswordController',
//]);
//Route::get('/', ['as' => 'home' ,'uses' => 'HomeController@index']);
//Route::bind('tag', function($value, $route){
//    return Tag::where('id', $value)->first();
//});

Route::filter('no-cache',function($route, $request, $response){
    $response->headers->set('Cache-Control','nocache, no-store, max-age=0, must-revalidate');
    $response->headers->set('Pragma','no-cache');
    $response->headers->set('Expires','Fri, 01 Jan 1990 00:00:00 GMT');
});

Route::get('/', 'NewController@index');
Route::get('/guest', 'NewController@guest');
Route::controllers(['auth' => 'Auth\AuthController']);
Route::get('/homepage', 'HomeController@emergency');
Route::group(['middleware' => 'auth', 'after' => 'no-cache'], function () {
	Route::get('/dash-board', 'DashBoardController@index');
	Route::get('/student', 'DashBoardController@student');
});
//Route::get('/auth/login', 'Auth\AuthController@getLogin');
Route::get('/auth/register', 'Auth\AuthController@getRegister');
Route::get('/auth/login', 'Auth\AuthController@getLogin');
//Route::get('/auth/logout', 'Auth\AuthController@getLogout');
//Route::get('/home', 'HomeController@emergency');

Route::resource('/tags', 'TagController');
Route::get('/delete/{id}', array('as' => 'delete', 'uses' => 'TagController@getDelete'));
Route::get('/ece', 'AdminController@getEceFac');
Route::get('/bba', 'AdminController@getBbaFac');
Route::get('/eng', 'AdminController@getEngFac');
