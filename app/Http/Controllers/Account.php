<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class Account extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function showRegistration()
    {
        return view('registration');
    }

    public function showHome()
    {
        return view('home');
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:30|regex:/^[a-zA-Z]+$/',
            'last_name' => 'required|string|max:30|regex:/^[a-zA-Z]+$/',
            'email' => 'required|email|unique:users|max:60',
            'password' => 'required|string',
            'phone' => 'required|numeric|digits_between:8,15',
            'gender' => 'required|in:Male,Female',
            'date_of_birth' => 'required|date',
            'user_role' => 'required|in:Buyer,Seller',
            'siup' => 'required_if:user_role,Seller|file|mimes:jpeg,jpg,png|max:2048',
        ]);

        $siupPath = null;
        if ($request->user_role == 'Seller' && $request->hasFile('siup')) {
            $file = $request->file('siup');
            $siupPath = 'siup_document/SIUP_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('siup_document/'), $siupPath);
        }

        $profile_pic_def = 'asset/profile.png';

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => md5($request->password),
            'phone' => $request->phone,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'profile_picture' => $profile_pic_def,
            'user_role' => $request->user_role,
            'siup' => $siupPath,
            'registration_date' => date('Y-m-d'),
            'account_status' => $request->user_role === 'Seller' ? 'Pending' : null,
        ]);

        Session::flash('message_regis', 'Registration successful! Please log in.');

        return redirect()->route('login.view');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:60',
            'password' => 'required|string|max:20',
        ]);

        $user = DB::table('user')
        ->where('email', $validated['email'])
        ->where('password', md5($validated['password']))
        ->first();

        if ($user) {
            Session::put('user_id', $user->user_id);
            Session::put('first_name', $user->first_name);
            Session::put('user_role', $user->user_role);
    
            if ($user->user_role == 'Seller') {
                if ($user->account_status == 'Rejected') {
                    Session::flash('message', 'Your account is rejected. Reason: ' . $user->admin_notes);
                    return redirect()->route('login.view');
                } elseif ($user->account_status == 'Pending') {
                    Session::flash('message', 'Your account is under review. Please wait for approval.');
                    return redirect()->route('login.view');
                }
            }
            return redirect()->route('home.view')->with('success', 'Login successful!');
        } else {
            Session::flash('message', 'Invalid email or password.');
        }

        return back()->withErrors(['email' => 'Invalid email or password'])->withInput();
    }

    public function home()
    {
        return view('homepage');
    }
}