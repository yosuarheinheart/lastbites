<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Logout extends Controller
{
    
    public function logout()
    {
        Session::flush();
        Session::invalidate();


        return redirect('/login')->with('success', 'You have been logged out.');

    }
}