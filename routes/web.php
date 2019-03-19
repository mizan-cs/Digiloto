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

Route::get('/', function () {
	return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/operator/become','OrganizerController@create')->name('organizer.create');
Route::post('/operator/become','OrganizerController@store')->name('organizer.store');


Route::group(['middleware' => ['operator']], function () {
	Route::get('/operator','OrganizerController@dashboard')->name('organizer.dashboard');
	Route::get('/operator/settings','OrganizerController@settings')->name('organizer.settings');
<<<<<<< HEAD
	Route::patch('/operator/{id}','OrganizerController@update');
	// Route::get();
=======
	Route::post('/operator/settings','OrganizerController@update')->name('organizer.update');
	
>>>>>>> c8f141ab20fe7b46282fcf196621ba2653d0b362
});




Route::group(['prefix' => 'admin'], function () {
	Voyager::routes();
});
