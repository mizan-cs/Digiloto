<?php

namespace App\Http\Controllers;

use App\Agent;
use App\Game;
use App\Invite;
use App\Mail\InviteAgent;
use App\Mail\NewAgentAdded;
use App\Message;
use App\Room;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class AgentController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('auth')->except('create','store');
        \View::share('tab','agents');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($token)
    {
        $invite = Invite::where('token',$token)->first();

        if ($invite){
            $user = User::where('email', $invite->email)->first();

            if ($user)
            {
                return view('organizer.agents.create', compact('invite', 'user'));
            }
            else
            {
                // Send for new User

                return view('organizer.agents.new_create', compact('invite'));
            }
            //dd($invite->email);
        }
        else
        {
            abort(404);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $token)
    {
        $invite = Invite::where('token',$token)->first();
        if ($invite){
            $user = User::where('email', $invite->email)->first();

            if ($user)
            {
                // validate
                $rules = array(
                    'title' => ['required', 'string', 'max:255'],
                );
                $validator = \Validator::make($request->all(), $rules);

                // process the validation
                if ($validator->fails()) {
                    return \Redirect::route('organizer.agent.create',$invite->token)
                        ->withErrors($validator)
                        ->withInput();
                } else {
                    $user->is_agent = true;
                    $user->save();

                    $agent = new Agent();
                    $agent->name            =   $request->get('title');
                    $agent->user_id         =   $user->id;
                    $agent->organizer_id    =   $invite->organizer->id;
                    $agent->save();

                    Mail::to(['email'=>$invite->organizer->email])->send(new NewAgentAdded($agent));

                    $invite->delete();

                    return \Redirect::route('agent.dashboard');
                }
            }
            else
            {
                // validate
                $rules = array(
                    'name' => ['required', 'string', 'max:255'],
                    'title' => ['required', 'string', 'max:255'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                );
                $validator = \Validator::make($request->all(), $rules);

                // process the validation
                if ($validator->fails()) {
                    return \Redirect::route('organizer.agent.create',$invite->token)
                        ->withErrors($validator)
                        ->withInput();
                } else {


                    $user = User::create([
                        'name'      => $request->get('name'),
                        'email'     => $invite->email,
                        'password'  => Hash::make($request->get('password')),
                        'is_agent'  => true,

                    ]);

                    $user->is_agent = true;
                    $user->save();

                    $agent = new Agent();
                    $agent->name            =   $request->get('title');
                    $agent->user_id         =   $user->id;
                    $agent->organizer_id    =   $invite->organizer->id;
                    $agent->save();

                    $room  = new Room();
                    $room->sender_id = $user->id;
                    $room->receiver_id = $invite->organizer->id;
                    $room->save();
                    $room->users()->attach($user->id);
                    $room->users()->attach($invite->organizer->id);
                    $room->save();

                    $message = new Message();
                    $message->user_id = $invite->organizer->id;
                    $message->message = "Hi, I'm your operator.";
                    $message->room_id = $room->id;
                    $message->save();

                    Mail::to(['email'=>$invite->organizer->email])->send(new NewAgentAdded($agent));

                    $invite->delete();

                    return \Redirect::route('agent.dashboard');
                }

            }
        }
        else
        {
            abort(404);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function invite()
    {
        $tab = 'agents';
        $sub_tab = 'agents-index';

        return view('organizer.agents.invite', compact('tab','sub_tab'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function send_invite(Request $request)
    {
        $email = $request->get('email');
        $user = User::where('email', $email)->first();

        if ($user)
        {
            if ($user->agent)
            {
                \Session::flash('status', 'A user can not become agent for multiple operator.');
                \Session::flash('alert-class', 'alert-warning');
                return \Redirect::back();
            }

            if ($user->is_operator)
            {
                \Session::flash('status', 'This user already operator.');
                \Session::flash('alert-class', 'alert-warning');
                return \Redirect::back();
            }
        }

        $invite = new Invite();
        $invite->email = $email;
        $invite->token = Str::random(60);
        $invite->organizer_id = Auth::user()->organizers[0]->id;
        $invite->save();
        Mail::to(['email'=>$email])->send(new InviteAgent($invite));

        \Session::flash('status', 'A invitation mail has been sent to '.$invite->email.".");
        \Session::flash('alert-class', 'alert-success');
        return \Redirect::back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function show(Agent $agent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function edit(Agent $agent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agent $agent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agent $agent)
    {
        //
    }

    public function dashboard()
    {
        $tab = 'agents';
        $sub_tab = 'agents-index';

        return view('organizer.agents.index', compact('tab','sub_tab'));
    }

    public function approve(Agent $agent)
    {
        $tab = 'agents';
        $sub_tab = 'agents-index';

        if (Auth::user()->organizers[0]->agents->find($agent->id)->get())
        {
            $agent->is_active = true;
            $agent->save();
            \Session::flash('status', 'Agent '.$agent->name.' is active now!');
            \Session::flash('alert-class', 'alert-success');
            return Redirect::route('organizer.agent.index');
        }
        else
        {
            abort(404);
        }
    }

    public function deactivate(Agent $agent)
    {
        $tab = 'agents';
        $sub_tab = 'agents-index';
        //dd(Auth::user()->organizers[0]->agents->find($agent->id)->get());
        if (Auth::user()->organizers[0]->agents->find($agent->id)->get())
        {
            $agent->is_active = false;
            $agent->save();
            \Session::flash('status', 'Agent '.$agent->name.' is deactivate now!');
            \Session::flash('alert-class', 'alert-success');
            return Redirect::route('organizer.agent.index');
        }
        else
        {
            abort(404);
        }
    }

    public function update_commission(Request $request ,Agent $agent)
    {
        $tab = 'agents';
        $sub_tab = 'agents-index';
        //dd(Auth::user()->organizers[0]->agents->find($agent->id)->get());
        if (Auth::user()->organizers[0]->agents->find($agent->id)->get())
        {
            $commission = $request->get('commission');

            if ($commission < 0 || $commission > 100)
            {
                \Session::flash('status', 'Invalid Commission Input');
                \Session::flash('alert-class', 'alert-danger');
                return Redirect::route('organizer.agent.index');
            }

            $agent->commission = $request->get('commission');
            $agent->save();
            \Session::flash('status', 'Agent '.$agent->name.' commission is updated');
            \Session::flash('alert-class', 'alert-success');
            return Redirect::route('organizer.agent.index');
        }
        else
        {
            abort(404);
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
