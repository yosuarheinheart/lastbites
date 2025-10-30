<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class Store extends Controller
{
    public function index($store_id)
        {
            $user_id = Session::get('user_id');

            if (!$user_id) {
                return redirect()->route('login.view');
            }

            $user = DB::table('user')
                ->select('user_role', 'profile_picture')
                ->where('user_id', $user_id)
                ->first();

            $isSeller = $user->user_role === 'Seller';
            $ownStore = $isSeller ? DB::table('store')->where('user_id', $user_id)->first() : null;

            $cartStoreIds = DB::table('cart_item')
                ->join('cart', 'cart_item.cart_id', '=', 'cart.cart_id')
                ->join('product', 'cart_item.product_id', '=', 'product.product_id')
                ->where('cart.user_id', $user_id)
                ->distinct()
                ->pluck('product.store_id');

            $cartHasOtherStore = $cartStoreIds->isNotEmpty() && !$cartStoreIds->contains($store_id);

            if ($cartHasOtherStore) {
                Session::flash('cart_alert', [
                    'message' => 'Your cart contains items from another store. Do you want to clear your cart before shopping at this store?',
                    'store_id' => $store_id
                ]);
            }

            $store = DB::table('store')->where('store_id', $store_id)->first();

            $ratingData = DB::table('rating_review')
                ->join('transaction', 'rating_review.transaction_id', '=', 'transaction.transaction_id')
                ->where('transaction.store_id', $store_id)
                ->selectRaw('AVG(rating) as average_rating, COUNT(*) as review_count')
                ->first();

            $products = DB::table('product')->where('store_id', $store_id)->get();

            $reviews = DB::table('rating_review')
                ->join('transaction', 'rating_review.transaction_id', '=', 'transaction.transaction_id')
                ->where('transaction.store_id', $store_id)
                ->select('rating', 'review')
                ->take(2)
                ->get();

            $cartItems = DB::table('cart_item')
                ->join('cart', 'cart_item.cart_id', '=', 'cart.cart_id')
                ->where('cart.user_id', $user_id)
                ->pluck('product_id')
                ->toArray();

            $cartItemCount = DB::table('cart_item')
                ->join('cart', 'cart_item.cart_id', '=', 'cart.cart_id')
                ->where('cart.user_id', $user_id)
                ->sum('quantity');

            return view('store', compact(
                'user',
                'ownStore',
                'isSeller',
                'store',
                'products',
                'reviews',
                'ratingData',
                'store_id',
                'cartItems',
                'cartItemCount',
                'cartHasOtherStore'
            ));
        }

    public function allReviews($store_id)
        {
            $user_id = Session::get('user_id');

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

            $store = DB::table('store')->where('store_id', $store_id)->first();

            if (!$store) {
                abort(404, 'Store not found.');
            }

            $allReviews = DB::table('rating_review')
                ->join('transaction', 'rating_review.transaction_id', '=', 'transaction.transaction_id')
                ->join('user', 'rating_review.user_id', '=', 'user.user_id')
                ->join('product', 'rating_review.product_id', '=', 'product.product_id')
                ->where('transaction.store_id', $store_id)
                ->select(
                    'rating_review.review',
                    'rating_review.rating',
                    'rating_review.review_date',
                    'user.first_name',
                    'user.last_name',
                    'product.product_name'
                )
                ->get();

            return view('storereview', compact('store', 'allReviews', 'user', 'ownStore', 'isSeller'));
        }
}
?>