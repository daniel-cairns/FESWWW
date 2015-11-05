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

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');


// Pages

Route::get('weddings', 'WeddingsController@index');

Route::get('portraits', 'PortraitsController@index');

Route::get('seniors', 'SeniorsController@index');

Route::get('commercial', 'CommercialController@index');

Route::get('models', 'ModelsController@index');

Route::get('gallery', 'GalleryController@index');

Route::get('about', 'AboutController@index');

Route::get('packages', 'PackagesController@index');

Route::get('contact', 'ContactController@index');

// Registration
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Login
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');

// Logout
Route::get('auth/logout', 'Auth\AuthController@getLogout');
