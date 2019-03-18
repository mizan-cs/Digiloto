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

Route::get('/operator','OrganizerController@dashboard')->name('organizer.dashboard');
Route::get('/operator/become','OrganizerController@create')->name('organizer.create');
Route::post('/operator/become','OrganizerController@store')->name('organizer.store');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
