<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class AdminDashboard extends Controller {
    public function index() {
        if (!Session::has('email')) {
            return redirect()->route('admin.login')->with('message', 'Silakan login terlebih dahulu.');
        }

        $users = User::where('user_role', 'Seller')
                     ->where('account_status', 'Pending')
                     ->get();
                     
        return view('admin.dashboard', compact('users'));
    }

    public function processAction(Request $request) {
        
        $request->validate([
            'user_id' => [
                'required',
                function ($attribute, $value, $fail) {
                    $exists = DB::table('user')->where('user_id', $value)->exists();
                    if (!$exists) {
                        $fail('The selected user_id is invalid.');
                    }
                }
            ],
            'action' => 'required|in:approve,reject',
        ]);

        $userId = $request->input('user_id');
        $action = $request->input('action');
        $newStatus = $action === 'approve' ? 'Approved' : 'Rejected';

        $user = User::findOrFail($userId);

        if($newStatus === 'Rejected') {
            $rejectionNote = $request->input('rejection_note', '');
            $user->account_status = $newStatus;
            $user->admin_notes = $rejectionNote;
        } else {
            $user->account_status = $newStatus;
            $user->admin_notes = null;
        }

        $user->save();

        return redirect()->route('admin.dashboard')->with('message', 'Aksi berhasil diproses.');
    }
}