<?php

namespace App\Http\Controllers;

use App\Order;
use App\Ticket;
use App\User;
use App\Agent;
use Carbon\Carbon;
use Composer\Package\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Stripe\Charge;
use Stripe\Stripe;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('auth');

    }
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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->get('refer'))
        {
            $agent = Agent::where('token', $request->get('refer'))->first();
        }
        else
        {
            $agent = null;
        }

        $tickets = $request->get('tickets');

        $tic = [];
        $total = 0;

        foreach ($tickets as $ticket)
        {
            $t = Ticket::find($ticket);
            if ($t)
            {
                if (!$t->is_active ||  $t->is_winner || $t->is_sold)
                {
                    \Session::flash('status', 'Invalid Selection');
                    \Session::flash('alert-class', 'alert-danger');
                    return \Redirect::back();
                }
                $total = $total + $t->price;
                array_push($tic,$t);
            }
            else
            {
                \Session::flash('status', 'Invalid Selection');
                \Session::flash('alert-class', 'alert-danger');
                return \Redirect::back();
            }

        }

        if ($agent)
        {
            $data = [
                'refer' =>  $agent,
                'tickets'   =>  $tic
            ];
        }
        else
        {
            $data = [
                'refer' =>  'no',
                'tickets'   =>  $tic
            ];
        }

        //dd();
        $game = $tic[0]->game;

        //dd($data->tickets);
        return view('public.games.checkout',compact('data', 'game','total'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function complete(Request $request, $data)
    {

        $tickets = $request->get('tickets');
        $total = 0;

        foreach ($tickets as $ticket)
        {
            $t = Ticket::find($ticket);
            if ($t)
            {
                //dd($t[0]);
                if (!$t[0]->is_active ||  $t[0]->is_winner || $t[0]->is_sold)
                {
                    \Session::flash('status', 'Invalid Selection');
                    \Session::flash('alert-class', 'alert-danger');
                    return \Redirect::back();
                }
                $total = $total + $t[0]->price;
            }
            else
            {
                \Session::flash('status', 'Invalid Selection');
                \Session::flash('alert-class', 'alert-danger');
                return \Redirect::back();
            }

        }

        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->order_reference = substr($request->get('_token'),0,5).'g'.$tickets[0]->game->id;
        $order->fee = $total;
        $order->date = Carbon::now()->toDateString();
        $order->game_id = $tickets[0]->game->id;
        $order->created_at = Carbon::now();

        if ($request->get('refer') == 'no')
        {
            $order->agent_fee = 0;
        }
        else
        {
            $agent = Agent::find($request->get('refer'));
            if ($agent)
            {
                $fee = $agent->commission*$total/100;
                $order->agent_fee = $fee;
            }
            else
            {
                $order->agent_fee = 0;
            }
        }

        Stripe::setApiKey(env('STRIPE_SECRET'));
        $stripe = Charge::create([
            'amount' =>  $total * 100,
            'currency'  =>  'usd',
            'source'    =>  $request->get('stripeToken'),
            'description'   =>  'Payment for Game '.$tickets[0]->game->id,
        ]);

        dd($stripe);

        //dd($data->tickets);
        return view('public.games.checkout',compact('data', 'game','total'));



    }
}
