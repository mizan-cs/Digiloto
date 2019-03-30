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

Route::get('/', 'HomeController@home')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/home/dashboard', 'HomeController@dashboard')->name('user.dashboard.base');
Route::get('/games', 'HomeController@games')->name('games');
Route::get('/games/{game}', 'GameController@show')->name('games.show');
Route::get('/operator/become','OrganizerController@create')->name('organizer.create');
Route::post('/operator/become','OrganizerController@store')->name('organizer.store');

Route::post('/operator/agents/become/{token}','AgentController@store')->name('organizer.agent.store');
Route::get('/operator/agents/become/{token}','AgentController@create')->name('organizer.agent.create');

Route::group(['middleware' => ['operator']], function () {
	Route::get('/operator','OrganizerController@dashboard')->name('organizer.dashboard');
	Route::get('/operator/settings','OrganizerController@settings')->name('organizer.settings');
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
    Route::get('/operator/games/dashboard/tickets/disable/{ticket}','TicketController@disable')->name('organizer.game.dashboard.tickets.disable');
    Route::get('/operator/games/dashboard/tickets/enable/{ticket}','TicketController@enable')->name('organizer.game.dashboard.tickets.enable');
    Route::get('/operator/games/dashboard/tickets/delete/{ticket}','TicketController@destroy')->name('organizer.game.dashboard.tickets.delete');
    Route::post('/operator/games/dashboard/tickets/update/{ticket}','TicketController@update')->name('organizer.game.dashboard.tickets.update');

    Route::get('/operator/agents','AgentController@dashboard')->name('organizer.agent.index');
    Route::get('/operator/agents/create','AgentController@invite')->name('organizer.agent.invite');
    Route::get('/operator/agents/approve/{agent}','AgentController@approve')->name('organizer.agent.approve');
    Route::get('/operator/agents/deactivate/{agent}','AgentController@deactivate')->name('organizer.agent.deactivate');
    Route::post('/operator/agents/update_commission/{agent}','AgentController@update_commission')->name('organizer.agent.update.commission');
    Route::post('/operator/agents/create','AgentController@send_invite')->name('organizer.agent.invite.send');

    //Messsage Controller
    Route::get('/operator/messages','RoomController@index')->name('organizer.message.index');
    Route::get('/operator/messages/{room}','RoomController@show')->name('organizer.message.show');
    Route::post('/operator/messages/{room}','RoomController@store')->name('organizer.message.send');
});

Route::group(['middleware' => ['agent']], function () {
    Route::get('/dashboard','AgentAdminController@dashboard')->name('agent.dashboard');
	Route::get('/dashboard/settings','OrganizerController@settings')->name('agent.settings');
	Route::post('/dashboard/settings','OrganizerController@update')->name('agent.update');


	// Game Manager
    Route::get('/dashboard/games','GameController@index')->name('agent.game.index');
    Route::get('/dashboard/games/dashboard/{game}','GameController@dashboard')->name('agent.game.dashboard');
    Route::get('/dashboard/games/settings/{game}','GameController@settings')->name('agent.game.settings');
    Route::post('/dashboard/games/update/{game}','GameController@update')->name('agent.game.update');
    Route::get('/dashboard/create','GameController@create')->name('agent.game.create');
    Route::post('/dashboard/create','GameController@store')->name('agent.game.store');

    //tickets
    Route::get('/dashboard/games/dashboard/tickets/{game}','TicketController@dashboard')->name('agent.game.dashboard.tickets');
    Route::get('/dashboard/games/dashboard/tickets/disable/{ticket}','TicketController@disable')->name('agent.game.dashboard.tickets.disable');
    Route::get('/dashboard/games/dashboard/tickets/enable/{ticket}','TicketController@enable')->name('agent.game.dashboard.tickets.enable');
    Route::get('/dashboard/games/dashboard/tickets/delete/{ticket}','TicketController@destroy')->name('agent.game.dashboard.tickets.delete');
    Route::post('/dashboard/games/dashboard/tickets/update/{ticket}','TicketController@update')->name('agent.game.dashboard.tickets.update');

    //Messsage Controller
    Route::get('/dashboard/messages','RoomController@index')->name('agent.message.index');
    Route::get('/dashboard/messages/{room}','RoomController@show')->name('agent.message.show');
    Route::post('/dashboard/messages/{room}','RoomController@store')->name('agent.message.send');

});


//Route::get('/operator/settings','OrganizerController@settings')->name('organizer.settings');
//Route::post('/operator/settings','OrganizerController@update')->name('organizer.update');



Route::group(['prefix' => 'admin'], function () {
	Voyager::routes();
});
