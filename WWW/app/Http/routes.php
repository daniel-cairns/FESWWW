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
Route::post('/home', 'HomeController@update');

Route::get('subbrand/{subbrand}', 'SubbrandController@index');
Route::get('subbrand/{subbrand}/{package}', 'SubbrandController@show');
Route::get('subbrand/{subbrand}/{package}/order', 'PackagesController@order');
Route::post('confirm', 'PackagesController@confirm');
Route::get('packages', 'PackagesController@index');

Route::get('gallery', 'GalleryController@index');

Route::get('about', 'AboutController@index');

Route::get('contact', 'ContactController@index');

Route::get('admin', 'AdminController@index');
Route::post('image', 'AdminController@storeImage');
Route::post('package', 'AdminController@storePackage');
Route::post('removePackage', 'AdminController@removePackage');
Route::post('removeImage', 'AdminController@removeImage');
Route::post('updateImage', 'AdminController@updateImage');

// Registration
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Login
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');

// Logout
Route::get('auth/logout', 'Auth\AuthController@getLogout');
