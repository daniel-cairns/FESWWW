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
Route::get('account', 'AccountController@index');

//Subbrands 
Route::get('subbrand/{subbrand}', 'SubbrandController@index');
Route::get('subbrand/{subbrand}/{package}', 'SubbrandController@show');
Route::get('subbrand/{subbrand}/{package}/order', 'PackagesController@order');
Route::post('updateSlider', 'SubbrandController@updateSlider');
Route::post('removeSlider', 'SubbrandController@removeSlider');
Route::post('updateCaption', 'SubbrandController@updateCaption');
Route::post('updateDescription', 'SubbrandController@updateDescription');

// Packages
Route::post('confirm', 'PackagesController@confirm');
Route::post('userConfirm', 'PackagesController@userConfirm');
Route::post('sendConfirm', 'PackagesController@sendConfirm');
Route::get('packages', 'PackagesController@index');
Route::post('cancelPackage', 'PackagesController@cancelPackage');
Route::post('uploadPackage', 'PackagesController@uploadPackage');

//Admin
Route::get('admin', 'AdminController@index');
Route::post('storeImage', 'AdminController@storeImage');
Route::post('storePackage', 'AdminController@storePackage');
Route::post('removePackage', 'AdminController@removePackage');
Route::post('removeImage', 'AdminController@removeImage');
Route::post('updateImage', 'AdminController@updateImage');
Route::post('updatePackage', 'AdminController@updatePackage');

Route::get('userDisplay/{id}', 'AdminController@userDisplay');
Route::get('userPackages/{id}', 'AdminController@userPackages');
Route::get('userImages/{description}', 'AdminController@userImages');
Route::post('userRemove', 'AdminController@userRemove');
Route::post('packageAssociation', 'AdminController@packageAssociation');

Route::post('updateSubbrandPackages', 'AdminController@updateSubbrandPackages');
Route::post('deletePackage', 'AdminController@deletePackage');

// Display pages
Route::get('gallery', 'GalleryController@index');
Route::get('about', 'AboutController@index');
Route::get('contact', 'ContactController@index');

// Registration
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Login
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');

// Logout
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Account
Route::post('password/reset', 'AccountController@resetPassword');
Route::post('email/reset', 'AccountController@resetEmail');
Route::post('username/reset', 'AccountController@resetUsername');

Route::get('migrate', function(){
	\Artisan::call('migrate');
});

Route::get('seed', function(){
	\Artisan::call('db:seed');
});

Route::get('reset', function(){
	\Artisan::call('migrate:refresh');
});

Route::get('clear', function(){
	\Artisan::call('cache:clear');
});

Route::get('cache', function(){
	\Artisan::call('config:cache');
});





