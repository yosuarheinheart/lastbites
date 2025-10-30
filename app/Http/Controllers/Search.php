<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Search extends Controller
{
    public function search(Request $request)
    {
        $user_id = Session::get('user_id');

        if (!Session::has('user_id')) {
            return redirect()->route('login.view');
        }

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

        $keyword = $request->input('search', '');

        $stores = DB::table('store')
            ->select('store.store_id', 'store.store_name', 'store.address', 'store.average_rating', 'store.status', 'store.store_picture')
            ->distinct()
            ->join('product', 'store.store_id', '=', 'product.store_id')
            ->where(function ($query) use ($keyword) {
                $query->where('store.store_name', 'like', "%$keyword%")
                      ->orWhere('product.product_name', 'like', "%$keyword%");
            })
            ->get();

        return view('search_results', compact('user', 'ownStore', 'isSeller','stores', 'keyword'));
    }
}