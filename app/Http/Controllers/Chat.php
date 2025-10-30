<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Chat extends Controller
{
    public function index($receiver_id)
    {
        if (!is_numeric($receiver_id)) {
            return redirect()->back()->withErrors('Invalid receiver ID.');
        }

        $user_id = Session::get('user_id');

        $recipient = DB::table('user')
            ->select('first_name', 'last_name', 'profile_picture')
            ->where('user_id', $receiver_id)
            ->first();
        
        $user = DB::table('user')
            ->select('first_name','user_role', 'profile_picture')
            ->where('user_id', $user_id)
            ->first(); 

        $isSeller = $user->user_role === 'Seller';

        $ownStore = null;
        if ($isSeller) {
            $ownStore = DB::table('store')
                ->where('user_id', $user_id) 
                ->first();
        }

        if (!$recipient) {
                return redirect()->back()->withErrors('Recipient not found.');
        }

        $messages = DB::table('chat')
            ->join('user', 'chat.sender_id', '=', 'user.user_id')
            ->select('chat.sender_id', 'chat.message', 'chat.sent_at', 'user.first_name', 'user.last_name', 'user.profile_picture')
            ->where(function ($query) use ($user_id, $receiver_id) {
                $query->where('chat.sender_id', $user_id)->where('chat.receiver_id', $receiver_id);
            })
            ->orWhere(function ($query) use ($user_id, $receiver_id) {
                $query->where('chat.sender_id', $receiver_id)->where('chat.receiver_id', $user_id);
            })
            ->orderBy('chat.sent_at', 'ASC')
            ->get();

        return view('chat', compact('recipient', 'user', 'user_id', 'isSeller', 'ownStore', 'messages', 'receiver_id'));
    }

    public function sendMessage(Request $request, $receiver_id) {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $user_id = Session::get('user_id');

        DB::table('chat')->insert([
            'sender_id' => $user_id,
            'receiver_id' => $receiver_id,
            'message' => $request->input('message'),
        ]);

        return redirect()->route('chat.view', ['receiver_id' => $receiver_id]);
    }
}

