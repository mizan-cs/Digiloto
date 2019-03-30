<?php

namespace App\Http\Controllers;

use App\Message;
use App\Room;
use Illuminate\Support\Facades\Auth;
use App\Organizer;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class OrganizerController extends Controller
{


 public function __construct()
 {
     $tab = 'dashboard';
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

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //TODO Check the validation
        if (Auth::user()->organizers()->count()){
            \Session::flash('status', 'You are already a operator. Welcome to your dashboard');
            \Session::flash('alert-class', 'alert-warning');
            return Redirect::route('organizer.dashboard');
        }else{
            return view('organizer.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $organizer = new Organizer();
        // validate
        $rules = array(
            'title'                 => 'required|string|max:255',
            'email'                 => 'required|email|max:255',
            'logo'                  => 'required|mimes:jpeg,bmp,png,jpg',
            'remember'            => 'required',

        );
        $validator = \Validator::make($request->all(), $rules);
        // process the login
        if ($validator->fails()) {
            return \Redirect::route('organizer.create')
            ->withErrors($validator)
            ->withInput();
        } else {

            if (Auth::user()->organizers()->count() == 0){

                $organizer->title = $request->get('title');
                $organizer->email = $request->get('email');
                $organizer->details = $request->get('details');
                if ($file = $request->file('logo')){
                    $name = time() . $file->getClientOriginalName();
                    $file->move('images',$name);
                    $organizer->logo = $name;
                }
                $organizer->user_id = Auth::user()->id;

                $organizer->save();
                

                $user = Auth::user();
                $user->is_operator = true;
                $user->save();
                $organizer = Auth::user()->organizers()->first();


                $room  = new Room();
                $room->sender_id = 1;
                $room->receiver_id = $organizer->user_id;
                $room->save();
                $room->users()->attach($organizer->user_id);
                $room->users()->attach(1);
                $room->save();

                $message = new Message();
                $message->user_id = 1;
                $message->message = "Hi, I'm here to help you. Feel free to ask any question";
                $message->room_id = $room->id;
                $message->save();


                \Session::flash('status', 'Your operator has been created');
                \Session::flash('alert-class', 'alert-success');
                return \Redirect::route('organizer.dashboard');
            }else{

                \Session::flash('status', 'You are already a operator. Welcome to your dashboard');
                \Session::flash('alert-class', 'alert-danger');
                return \Redirect::route('organizer.create');
            }

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Organizer  $organizer
     * @return \Illuminate\Http\Response
     */
    public function show(Organizer $organizer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Organizer  $organizer
     * @return \Illuminate\Http\Response
     */
    public function edit(Organizer $organizer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Organizer  $organizer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $organizer = Auth::user()->organizers()->first();
        abort_if($organizer->user_id !== Auth::user()->id,403);

        $data = $request->validate([
            'title' => 'required',
            'details' => 'required',
            'email' => 'required',
        ]);

        if ($file = $request->file('logo')){
            if (file_exists($organizer->logo)) {
                unlink($organizer->logo);    
            }

            $name = time() . $file->getClientOriginalName();
            $file->move('images',$name);
            $data['logo'] = $name;
        }   

        if ($file = $request->file('banner')){
            if (file_exists($organizer->banner)) {
                unlink($organizer->banner);    
            }

            $name = time() . $file->getClientOriginalName();
            $file->move('images',$name);
            $data['banner'] = $name;
        }

        $organizer->update($data);

        \Session::flash('status', 'Settings Updated Successfully');
        \Session::flash('alert-class', 'alert-success');
        return redirect(route('organizer.settings'));

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Organizer  $organizer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organizer $organizer)
    {
        //
    }

    public function dashboard()
    {
        $tab = 'dashboard';
        if (Auth::user()->organizers()->count() == 0)
        {
            \Session::flash('status', 'You have to create your organizer profile first to go dashboard');
            \Session::flash('alert-class', 'alert-warning');
            return Redirect::route('organizer.create');
        }

        $organizer = Auth::user()->organizers()->first();
        return view('organizer.dashboard',compact('organizer', 'tab'));
    }

    public function settings()
    {
        //TODO Check the validation
        $tab = 'settings';
        $organizer = Auth::user()->organizers()->first();
        return view('organizer.settings',compact('organizer','tab'));

    }

    public function check_if_user_own_this_org()
    {
        $organizer = Auth::user()->organizers()->first();
        if($organizer) {
            return $organizer->user->id == Auth::user()->id;
        }
        else{
            return false;
        }

    }
}
