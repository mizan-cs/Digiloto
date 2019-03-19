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

	Route::patch('/operator/{id}','OrganizerController@update');
	// Route::get();

	Route::post('/operator/settings','OrganizerController@update')->name('organizer.update');


	// Game Manager
    Route::get('/operator/games','GameController@index')->name('organizer.game.index');
    Route::get('/operator/games/dashboard/{game}','GameController@dashboard')->name('organizer.game.dashboard');
    Route::get('/operator/games/settings/{game}','GameController@settings')->name('organizer.game.settings');
    Route::post('/operator/games/update/{game}','GameController@update')->name('organizer.game.update');
    Route::get('/operator/create','GameController@create')->name('organizer.game.create');
    Route::post('/operator/create','GameController@store')->name('organizer.game.store');

    //tickets
    Route::get('/operator/games/dashboard/tickets/{game}','TicketController@dashboard')->name('organizer.game.dashboard.tickets');

});




Route::group(['prefix' => 'admin'], function () {
	Voyager::routes();
});
