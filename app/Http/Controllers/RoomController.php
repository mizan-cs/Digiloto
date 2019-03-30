<?php

namespace App\Http\Controllers;

use App\Message;
use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RoomController extends Controller
{
    public function __construct()
    {
        $tab = 'inbox';
        \Illuminate\Support\Facades\View::share(['tab'=>$tab]);
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Auth::user()->rooms;
        if (Auth::user()->isOperator())
        {
            return view('organizer.inbox', compact('rooms'));
        }
        elseif (Auth::user()->isAgent())
        {
            return view('agent.inbox', compact('rooms'));
        }
        else
        {
            abort(404);
        }
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
    public function store(Request $request, Room $room)
    {
        $message = new Message();
        $message->user_id = Auth::user()->id;
        $message->room_id = $room->id;
        $message->message = $request->get('message');
        $message->save();

        return \Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        $rooms = Auth::user()->rooms;
        if (Auth::user()->isOperator())
        {
            return view('organizer.message', compact('rooms','room'));
        }
        elseif (Auth::user()->isAgent())
        {
            return view('agent.message', compact('rooms','room'));
        }
        else
        {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        //
    }
}
