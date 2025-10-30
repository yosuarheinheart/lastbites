<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class ChatHistory extends Controller
{
    public function index()
    {
        $user_id = Session::get('user_id');

        if (!Session::has('user_id')) {
            return redirect()->route('login.view');
        }

        $user = DB::table('user') 
            ->select('first_name', 'user_role', 'profile_picture')
            ->where('user_id', $user_id) 
            ->first();

        $isSeller = $user->user_role === 'Seller';

        $ownStore = null;
        if ($isSeller) {
            $ownStore = DB::table('store')
                ->where('user_id', $user_id)
                ->first();
        }

        $chatPartners = DB::table('user as u') 
            ->select(
                'u.user_id as user_id', 
                'u.first_name',
                'u.last_name',
                'u.profile_picture',
                'latest_chat.message as latest_message',
                'latest_chat.sent_at as latest_message_time'
            )
            ->joinSub(
                DB::table('chat as c1')
                    ->select(
                        'c1.chat_id',
                        'c1.message',
                        'c1.sent_at',
                        DB::raw("CASE WHEN c1.sender_id = $user_id THEN c1.receiver_id ELSE c1.sender_id END AS partner_id")
                    )
                    ->joinSub(
                        DB::table('chat')
                            ->select(
                                DB::raw("CASE WHEN sender_id = $user_id THEN receiver_id ELSE sender_id END AS partner_id"),
                                DB::raw('MAX(sent_at) AS latest_sent_at')
                            )
                            ->where(function ($query) use ($user_id) {
                                $query->where('sender_id', $user_id)
                                    ->orWhere('receiver_id', $user_id);
                            })
                            ->whereColumn('sender_id', '!=', 'receiver_id')
                            ->groupBy('partner_id'),
                        'latest',
                        function ($join) {
                            $join->on(function ($join) {
                                $join->whereRaw('c1.sender_id = latest.partner_id')
                                    ->orWhereRaw('c1.receiver_id = latest.partner_id');
                            })
                                ->whereColumn('c1.sent_at', '=', 'latest.latest_sent_at');
                        }
                    ),
                'latest_chat',
                'u.user_id', 
                '=',
                'latest_chat.partner_id'
            )
            ->orderByDesc('latest_chat.sent_at')
            ->get();

        return view('chat_history', compact('chatPartners', 'user', 'ownStore', 'isSeller'));
    }

    private function formatTimestamp($timestamp)
    {
        $today = date('Y-m-d');
        $messageDate = date('Y-m-d', strtotime($timestamp));

        if ($today == $messageDate) {
            return date('H:i', strtotime($timestamp));
        } else {
            return date('j M Y', strtotime($timestamp));
        }
    }
}