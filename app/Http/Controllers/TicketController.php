<?php

namespace App\Http\Controllers;

use App\Game;
use App\Organizer;
use App\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }

    public function dashboard(Game $game)
    {
        //TODO Check the validation

        if ($this->check_if_orgnizer_own_this_game()) {

            $tab = 'games';
            $sub_tab = 'games-tickets';

            return view('organizer.game.tickets', compact('tab','sub_tab','game'));

        }else{
            \Session::flash('status', 'Access Denied');
            \Session::flash('alert-class', 'alert-danger');
            return Redirect::route('organizer.dashboard');
        }
    }


    public function check_if_orgnizer_own_this_game()
    {
        $game = Auth::user()->organizers->first()->games;
        //organizers->first()->games()->first()->organizer->id

        if($game) {
            return $game->first()->organizer->id == Auth::user()->organizers()->first()->id;
        }
        else{
            return false;
        }

    }
}
