<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgentAdminController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');

    }

    public function dashboard()
    {
        $tab = 'dashboard';
        $agent = Auth::user()->agent;
        return view('agent.dashboard', compact('agent','tab'));
    }
}
