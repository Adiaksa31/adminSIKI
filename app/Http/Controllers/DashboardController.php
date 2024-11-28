<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function __construct(Request $request)
    {
        // if(!isLogin($request)) abort(redirect()->route('login'));
    }

    public function dashboard(){
        return view('dashboard.dashboard');
    }
}

