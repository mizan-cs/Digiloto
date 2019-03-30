<?php

namespace App\Http\Controllers;

use App\Game;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use PragmaRX\Countries\Package\Countries;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('home');
        //\View::share('organizer', Auth::user()->organizer()->first());
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return \Redirect::route('home');
        //return view('home');
    }

    public function home()
    {
        //$a = Countries::all();
        //return Countries::where('name.common', 'Morocco')->first()->hydrateStates();
        //return Countries::all()->pluck('name.common');
        //dd($a->where('name.common', 'Bangladesh'));
        //dd(Countries::where('cca3', 'BGD')->first()->hydrateStates()->states->pluck('name', 'postal'));
//        foreach ($a as $data)
//        {
//            dd($data->name->common);
//        }
        return view('welcome');
    }

    public function games()
    {
        $games = Game::ofActive()->get();
        //dd();
        return view('home', compact('games'));
    }

    public function dashboard()
    {
        if (Auth::user()->is_agent)
        {
            return Redirect::route('agent.dashboard');
        }
        elseif(Auth::user()->is_operator)
        {
            return Redirect::route('organizer.dashboard');
        }
        else{
            abort(404);
        }
    }
}
