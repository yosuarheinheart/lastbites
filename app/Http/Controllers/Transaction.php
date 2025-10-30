<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Transaction extends Controller
{
    public function index()
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

        $transaction = DB::table('transaction')
            ->where('user_id', $user_id)
            ->orderBy('transaction_date', 'desc')
            ->get()
            ->map(function ($transaction) {
                $transaction->store = DB::table('stores')
                    ->where('store_id', $transaction->store_id)
                    ->first();

                $transaction->items = DB::table('transaction_item')
                    ->where('transaction_id', $transaction->id)
                    ->get();

                return $transaction;
            });

        return view('history', compact('user', 
            'ownStore', 
            'isSeller', 
            'cartItems', 
            'totalCost'));
    }

    public function showTransactionPage(Request $request)
    {
        $user_id = Session::get('user_id');

        $user = DB::table('user')
            ->select('first_name', 'profile_picture', 'user_role')
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

        $cartItems = DB::table('cart_item')
            ->join('cart', 'cart_item.cart_id', '=', 'cart.cart_id')
            ->join('product', 'cart_item.product_id', '=', 'product.product_id')
            ->where('cart.user_id', $user_id)
            ->select(
                'product.product_name',
                'cart_item.quantity',
                'product.price',
                DB::raw('(product.price * cart_item.quantity) as total_price')
            )

            ->get();

        $totalCost = $cartItems->sum('total_price');

        return view('transaction', compact(
            'user', 
            'ownStore', 
            'isSeller', 
            'cartItems',
            'totalCost'
        ));
    }

    public function processTransaction(Request $request)
{
    $user_id = Session::get('user_id');

    if (!$user_id) {
        return redirect()->route('login.view')->with('error', 'You must log in first.');
    }

    $cartItems = DB::table('cart_item')
        ->join('cart', 'cart_item.cart_id', '=', 'cart.cart_id')
        ->join('product', 'cart_item.product_id', '=', 'product.product_id')
        ->where('cart.user_id', $user_id)
        ->select('cart_item.product_id', 'cart_item.quantity', 'product.price', 'product.store_id')
        ->get();

    if ($cartItems->isEmpty()) {
        return back()->with('error', 'Your cart is empty.');
    }

    $storeId = $cartItems->first()->store_id;
    $totalCost = $cartItems->sum(fn ($item) => $item->price * $item->quantity);

    DB::beginTransaction();

    try {
        $transactionId = DB::table('transaction')->insertGetId([
            'user_id' => $user_id,
            'store_id' => $storeId,
            'total_amount' => $totalCost,
            'payment_method' => 'cod',
            'payment_status' => 'pending',
            'transaction_date' => now(),
            'status_updated_at' => now(),
        ]);

        foreach ($cartItems as $item) {
            DB::table('transaction_item')->insert([
                'transaction_id' => $transactionId,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->price,
            ]);
        }

        DB::table('cart_item')
            ->join('cart', 'cart_item.cart_id', '=', 'cart.cart_id')
            ->where('cart.user_id', $user_id)
            ->delete();

        DB::commit();

        logger('Transaction completed, redirecting to success page.');
        return redirect()->route('transaction.success', ['transactionId' => $transactionId]);

    } catch (\Exception $e) {
        DB::rollBack();
        logger('Transaction failed: ' . $e->getMessage());
        return back()->with('error', 'Transaction failed: ' . $e->getMessage());
    }
}



public function showTransactionSuccess($transactionId)
{
    $user_id = Session::get('user_id');

    if (!$user_id) {
        return redirect()->route('login.view')->with('error', 'You must log in first.');
    }
    $user = DB::table('user')
            ->select('user_role', 'profile_picture')
            ->where('user_id', $user_id)
            ->first(); 

    $transaction = DB::table('transaction')
        ->join('store', 'transaction.store_id', '=', 'store.store_id')
        ->where('transaction.user_id', $user_id)
        ->where('transaction.transaction_id', $transactionId)
        ->select('transaction.*', 'store.store_name', 'store.address')
        ->first();

        $isSeller = $user->user_role === 'Seller';

        $ownStore = null;
        if ($isSeller) {
            $ownStore = DB::table('store')
                ->where('user_id', $user_id) 
                ->first();
        }

        $cartItems = DB::table('cart_item')
        ->join('cart', 'cart_item.cart_id', '=', 'cart.cart_id')
        ->join('product', 'cart_item.product_id', '=', 'product.product_id')
        ->where('cart.user_id', $user_id)
        ->select(
            'product.product_name',
            'cart_item.quantity',
            'product.price',
            DB::raw('(product.price * cart_item.quantity) as total_price')
        );

        
       
    if (!$transaction) {
        logger('Transaction not found for ID: ' . $transactionId);
        return redirect()->route('home.view')->with('error', 'Transaction not found.');
    }



    return view('transactionsuccess', compact('user', 
            'ownStore', 
            'isSeller', 
            'cartItems',
            'transaction'));
}
}
?>