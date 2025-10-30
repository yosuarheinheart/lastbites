<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\RatingReview;

class History extends Controller
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

        $transactions = DB::table('transaction as t')
            ->join('store as s', 't.store_id', '=', 's.store_id')
            ->select(
                't.transaction_id',
                't.transaction_date',
                't.total_amount',
                't.payment_status',
                's.store_name',
                's.address'
            )
            ->where('t.user_id', $user_id)
            ->orderByDesc('t.transaction_date')
            ->get();

        $products = DB::table('transaction_item as ti')
            ->join('product as p', 'ti.product_id', '=', 'p.product_id')
            ->select(
                'ti.transaction_id',
                'ti.quantity',
                'p.product_name',
                'p.product_id'
            )
            ->whereIn(
                'ti.transaction_id',
                DB::table('transaction')
                    ->select('transaction_id')
                    ->where('user_id', $user_id)
            )
            ->get();

        $products_map = $products->groupBy('transaction_id');

        $reviews = DB::table('rating_review')
            ->where('user_id', $user_id)
            ->get();

        $reviews_map = $reviews->keyBy('transaction_id');

        return view('history', [
            'transactions' => $transactions,
            'products_map' => $products_map,
            'reviews_map' => $reviews_map,
            'user' => $user, 
            'ownStore' => $ownStore, 
            'isSeller' => $isSeller,
        ]);
    }

    public function submitReview(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|exists:transaction,transaction_id',
            'user_id' => 'required|exists:user,user_id',
            'product_id' => 'required|exists:product,product_id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:500',
        ]);

        $existingReview = RatingReview::where('transaction_id', $request->transaction_id)
            ->where('user_id', $request->user_id)
            ->first();

        if ($existingReview) {
            return redirect()->route('history.view')->with('error', 'You have already submitted a review for this transaction.');
        }

        RatingReview::create([
            'transaction_id' => $request->transaction_id,
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return redirect()->route('history.view')->with('success', 'Review submitted successfully!');
    }
}
?>