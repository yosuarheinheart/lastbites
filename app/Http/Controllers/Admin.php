<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Admins;

class Admin extends Controller {
    public function showLoginForm() {
        return view('admin.login');
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = Admins::where('email', $request->email)->first();

        if($admin && $request->password === $admin->password) {
            session(['email' => $admin->email, 'admin_name' => $admin->admin_name]);

            return redirect()->route('admin.dashboard');
        }

        return back()->with('message', 'Email atau password salah.')->withInput();
    }

    public function logout() {
        Session::flush();
        return redirect()->route('admin.login')->with('message', 'Anda telah berhasil logout.');
    }
}