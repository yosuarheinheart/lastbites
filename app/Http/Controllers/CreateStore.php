<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CreateStore extends Controller {
    public function showForm() {
        $user_id = Session::get('user_id');
        $user_role = Session::get('user_role');

        if (!$user_id || $user_role !== 'Seller') {
            return redirect()->route('home.view');
        }

        if (!Session::has('user_id')) {
            return redirect()->route('login.view');
        }

        $user = DB::table('user')
            ->select('user_role', 'profile_picture')
            ->where('user_id', $user_id)
            ->first(); 

        $isSeller = $user->user_role === 'Seller';

        $ownStore = null;
        if ($isSeller) {
            $ownStore = DB::table('store')
                ->where('user_id', $user_id) 
                ->first();
        }

        $store = DB::table('store')->where('user_id', $user_id)->first();
        if ($store) {
            Session::flash('message', 'You already have a store.');
            return redirect()->route('home.view');
        }

        return view('store_create', compact('user', 'isSeller', 'ownStore'));
    }

    public function createStore(Request $request) {
        $request->validate([
            'store_name' => 'required|string|max:255',
            'store_description' => 'required|string|max:1000',
            'address' => 'required|string|max:1000',
            'store_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $store_picture_path = "asset/store.jpg";


        if ($request->hasFile('store_picture')) {
            $file = $request->file('store_picture');
            $store_picture_path = 'upload/store/' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/store'), $store_picture_path);
        }

        $user_id = Session::get('user_id');

        DB::table('store')->insert([
            'store_name' => $request->store_name,
            'store_description' => $request->store_description,
            'user_id' => $user_id,
            'store_picture' => $store_picture_path,
            'address' => $request->address,
            'status' => 'Inactive',
        ]);

        Session::flash('message', 'Store created successfully.');
        return redirect()->route('home.view');
    }
}