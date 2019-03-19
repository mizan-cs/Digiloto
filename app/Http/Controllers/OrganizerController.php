<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Organizer;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Redirect;

class OrganizerController extends Controller
{


 public function __construct()
 {
     $tab = 'tab';
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

               if ($file = $request->file('logo')){
                $name = time() . $file->getClientOriginalName();
                $file->move('images',$name);
                $data['logo'] = $name;
            }

               $data['user_id'] = Auth::user()->id;
               Organizer::create($data);

               $user = Auth::user()->id;
               $user->is_operator = true;
               $user->save();
               $organizer = Auth::user()->organizers()->first();

               \Session::flash('status', 'Your operator has been created');
               \Session::flash('alert-class', 'alert-success');
               return \Redirect::route('organizer.dashboard',compact('organizer'));
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
        $organizer = Auth::user()->organizers()->first();
        return view('organizer.dashboard',compact('organizer', 'tab'));
        // return $organizer;
    }

    public function settings(Organizer $organizer)
    {

        $tab = 'settings';
        $organizer = Auth::user()->organizers()->first();
        if ($this->check_if_user_own_this_org($organizer))
        {
            return view('organizer.settings',compact('organizer','tab'));
        }
        else
        {
            \Session::flash('status', 'Access Denied');
            \Session::flash('alert-class', 'alert-danger');
            return Redirect::route('home');
        }

    }

    public function check_if_user_own_this_org(Organizer $organizer)
    {
       return $organizer->user->id == Auth::user()->id;
    }
}
