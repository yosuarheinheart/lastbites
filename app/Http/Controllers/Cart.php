<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Cart extends Controller
{

    public function addToCart(Request $request)
        {
            $userId = Session::get('user_id');
            $productId = $request->input('product_id');

            $cartId = DB::table('cart')->where('user_id', $userId)->value('cart_id');

            if (!$cartId) {
                $cartId = DB::table('cart')->insertGetId([
                    'user_id' => $userId,
                ]);
            }

            $existingCartItem = DB::table('cart_item')
                ->where('cart_id', $cartId)
                ->where('product_id', $productId)
                ->first();

            if ($existingCartItem) {
                DB::table('cart_item')
                    ->where('cart_item_id', $existingCartItem->cart_item_id)
                    ->increment('quantity');
            } else {
                DB::table('cart_item')->insert([
                    'cart_id' => $cartId,
                    'product_id' => $productId,
                    'quantity' => 1,
                ]);
            }

            return back()->with('success', 'Product added to cart.');
        }


    public function removeFromCart(Request $request)
    {
        $userId = Session::get('user_id');

        if (!$userId) {
            return redirect()->route('login.view');
        }

        $productId = $request->input('product_id');

        $cartItem = DB::table('cart_item')
            ->join('cart', 'cart_item.cart_id', '=', 'cart.cart_id')
            ->where('cart.user_id', $userId)
            ->where('cart_item.product_id', $productId)
            ->first();

        if ($cartItem) {
            if ($cartItem->quantity > 1) {
                DB::table('cart_item')
                    ->where('cart_item.cart_item_id', $cartItem->cart_item_id)
                    ->decrement('quantity');
            } else {
                DB::table('cart_item')
                    ->where('cart_item.cart_item_id', $cartItem->cart_item_id)
                    ->delete();
            }

            return back()->with('warning', 'Product removed from cart.');
        }

        return back()->with('error', 'Product not found in cart.');
    }

    public function clear(Request $request)
        {
            $userId = Session::get('user_id');

            if (!$userId) {
                return redirect()->route('login.view');
            }

            $storeId = DB::table('cart_item')
                ->join('cart', 'cart_item.cart_id', '=', 'cart.cart_id')
                ->join('product', 'cart_item.product_id', '=', 'product.product_id')
                ->where('cart.user_id', $userId)
                ->value('product.store_id'); 

            if (!$storeId) {
                return redirect()->back();
            }

            DB::table('cart_item')
                ->join('cart', 'cart_item.cart_id', '=', 'cart.cart_id')
                ->where('cart.user_id', $userId)
                ->delete();

            return redirect()->route('store.view', ['store_id' => $storeId])
                ->with('success', 'Your cart has been cleared.');
        }
        
}
?>