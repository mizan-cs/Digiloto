<?php

namespace App\Http\Controllers;

use App\Game;
use App\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organizer = Auth::user()->organizers()->first();
        $games = $organizer->games;
        $tab = 'games';
        return view('organizer.game.index', compact('tab','organizer','games'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $organizer = Auth::user()->organizers()->first();
        $tab = 'create-games';
        return view('organizer.game.create', compact('tab','organizer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //TODO Check the validation

        //dd();
        $game = new Game();
        $game->title        = $request->get('title');
        $game->total_tickets= $request->get('total_tickets');
        $game->start_at     = $request->get('start_at');
        $game->end_at       = $request->get('end_at');
        $game->rules        = $request->get('rules');
        $game->organizer_id = Auth::user()->organizers()->first()->id;

        $game->save();

        \Session::flash('status', 'Your Game has been created successfully. Please Go to dashboard to Make the game live');
        \Session::flash('alert-class', 'alert-success');
        return Redirect::route('organizer.game.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
        //TODO Check the validation

        //dd();
        $game->title        = $request->get('title');
        $game->total_tickets= $request->get('total_tickets');
        $game->start_at     = $request->get('start_at');
        $game->end_at       = $request->get('end_at');
        $game->rules        = $request->get('rules');
        $game->organizer_id = Auth::user()->organizers()->first()->id;
        $game->save();

        for ($i=0;$i<$game->total_tickets;$i++)
        {
            Ticket::created(array('game_id'=>$game->id));
        }

        \Session::flash('status', 'Your Game has been created Updated');
        \Session::flash('alert-class', 'alert-success');
        return Redirect::route('organizer.game.settings',$game);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        //
    }

    public function dashboard(Game $game)
    {
        //TODO Check the validation
        $tab = 'games';
        $sub_tab = 'games-dashboard';
        return view('organizer.game.dashboard', compact('game','tab','sub_tab'));
    }

    public function settings(Game $game)
    {
        //TODO Check the validation
        $organizer = Auth::user()->organizers()->first();
        $tab = 'games';
        $sub_tab = 'games-settings';
        return view('organizer.game.settings', compact('game','tab','sub_tab','organizer'));
    }
}
