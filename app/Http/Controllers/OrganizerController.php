<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Organizer;
use Illuminate\Http\Request;
use App\User;

class OrganizerController extends Controller
{


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

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        \Session::flash('status', 'This is a flash Message');
        \Session::flash('alert-class', 'alert-success');
        return view('organizer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
        // validate
        $rules = array(
            'title'                 => 'required|string|max:255',
            'email'                 => 'required|email|max:255',
            'logo'                  => 'mimes:jpeg,bmp,png,jpg',
            'remember'            => 'required|true',

        );
        $validator = \Validator::make($request->all(), $rules);

        // process the login
        if ($validator->fails()) {
            return \Redirect::route('')
                ->withErrors($validator)
                ->withInput();
        } else {

            \Session::flash('status', 'Your operator has been created');
            \Session::flash('alert-class', 'alert-success');
            return \Redirect::route('organizer.create');
        }












        $data = $request->validate([
            'title' => 'required',
            'email' => 'required',
            'details' => 'required',
        ]);

        if ($file = $request->file('logo')){
            $name = time() . $file->getClientOriginalName();
            $file->move('images',$name);
            $data['logo'] = $name;
        }
        $data['user_id'] = Auth::user()->id;

        Organizer::create($data);

        $user = User::findOrFail(Auth::user()->id);

        $user->update(['is_operator' => 1]);

        return redirect(route('organizer.dashboard'));

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
    public function update(Request $request, Organizer $organizer,$id)
    {
        $organizer = Organizer::findOrFail($id);

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

         return redirect(route('organizer.dashboard'))->with('message','Update Successfully');

        
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
        return view('organizer.dashboard');
    }

    public function settings(Organizer $organizer)
    {
        $organizer = Auth::user()->organizer()->whereUserId(auth()->id())->first();
        return view('organizer.settings',compact('organizer'));
    }
}
