<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class Profile extends Controller
{
    public function show()
{
    if (!Session::has('user_id')) {
        return redirect()->route('login.view'); 
    }

    $user_id = Session::get('user_id');  

    $user = DB::table('user')
        ->select('first_name', 'last_name', 'email', 'phone', 'gender', 'date_of_birth', 'user_role', 'profile_picture')
        ->where('user_id', $user_id)
        ->first();

    if (!$user) {
        return redirect()->route('login.view');  
    }

    $isSeller = $user->user_role === 'Seller';

    $ownStore = null;
    if ($isSeller) {
        $ownStore = DB::table('store')
            ->where('user_id', $user_id)
            ->first();
    }

    return view('profile', [
        'user' => $user,
        'isSeller' => $isSeller,
        'ownStore' => $ownStore
    ]);
}

    public function update(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);


        $user_id = Session::get('user_id');


        $user = DB::table('user')->where('user_id', $user_id)->first();  

        if (!$user) {
            return redirect()->route('login'); 
        }

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $product_picture_path = 'profile_pictures/' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('profile_pictures'), $product_picture_path);

            
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            DB::table('user')
                ->where('user_id', $user_id)
                ->update(['profile_picture' => $product_picture_path]);
        }

        DB::table('user')
            ->where('user_id', $user_id)
            ->update([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'phone' => $request->input('phone'),
            ]);

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }
}