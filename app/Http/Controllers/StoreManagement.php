<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class StoreManagement extends Controller
{   

    public function index()
        {
            $user_id = session('user_id');

            if (!$user_id) {
                return redirect()->route('login.view');
            }

            $user = DB::table('user')
                ->select('user_role', 'profile_picture')
                ->where('user_id', $user_id)
                ->first();

            if (!$user) {
                return back()->with('error', 'User not found. Please log in again.');
            }

            $isSeller = $user->user_role === 'Seller';

            $ownStore = null;
            if ($isSeller) {
                $ownStore = DB::table('store')
                    ->where('user_id', $user_id)
                    ->first();
            }

            try {
                $store = DB::table('store')->where('user_id', $user_id)->first();

                if (!$store) {
                    return back()->with('error', 'Store not found. Please contact support.');
                }

                $store_id = $store->store_id;

                $categories = DB::table('category')->get();
                $products = DB::table('product')->where('store_id', $store_id)->get();

                $transactions = DB::table('transaction')
                    ->join('user', 'transaction.user_id', '=', 'user.user_id')
                    ->where('transaction.store_id', $store_id)
                    ->where('transaction.payment_status', 'pending')
                    ->select('transaction.transaction_id', 'transaction.total_amount', 'transaction.payment_status', 'user.first_name', 'user.last_name')
                    ->get();

                $transaction_items = [];
                foreach ($transactions as $transaction) {
                    $items = DB::table('transaction_item')
                        ->join('product', 'transaction_item.product_id', '=', 'product.product_id')
                        ->where('transaction_item.transaction_id', $transaction->transaction_id)
                        ->select('product.product_name', 'transaction_item.quantity', 'transaction_item.price')
                        ->get();
                    $transaction_items[$transaction->transaction_id] = $items;
                }

                return view('store_management', compact('isSeller', 'ownStore', 'store', 'categories', 'products', 'user', 'transactions', 'transaction_items'));
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()]);
            }
        }


    public function updateStore(Request $request)
    {
        $request->validate([
            'store_name' => 'required|string|max:255',
            'store_description' => 'required|string|max:255',
            'store_address' => 'required|string|max:255',
            'store_status' => 'required|string|in:Active,Inactive',
            'store_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $store_id = $request->input('store_id');
        $store_picture_path = null;

        if ($request->hasFile('store_picture')) {
            $file = $request->file('store_picture');
            $store_picture_path = 'upload/store/' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/store'), $store_picture_path);
        }

        $updateData = [
            'store_name' => $request->input('store_name'),
            'store_description' => $request->input('store_description'),
            'address' => $request->input('store_address'),
            'status' => $request->input('store_status')
        ];

        if ($store_picture_path) {
            $updateData['store_picture'] = $store_picture_path;
        }

        DB::table('store')->where('store_id', $store_id)->update($updateData);

        Session::flash('message', 'Store updated successfully.');
        return redirect()->to(url('/store-management') . '#storeForm');
    }

    public function addProduct(Request $request)
    {

        $request->validate([
            'product_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|exists:category,category_id',
            'product_description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'product_status' => 'required|string|in:Available,Out of Stock',
        ]);

        $user_id = session('user_id');

        $store = DB::table('store')
                ->select('store_id')
                ->where('user_id', $user_id)
                ->first();

        $product_picture_path = "asset/product.jpg";

        if ($request->hasFile('product_picture')) {
            $file = $request->file('product_picture');
            $product_picture_path = 'upload/product/' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/product'), $product_picture_path);
        }

        DB::table('product')->insert([
            'store_id' => $store->store_id,
            'category_id' => $request->input('category_id'),
            'product_picture' => $product_picture_path,
            'product_name' => $request->input('product_name'),
            'product_description' => $request->input('product_description'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'status' => $request->input('product_status'),
        ]);

        Session::flash('message_add_product', 'Product added successfully.');
        return redirect()->to(url('/store-management') . '#productForm');
    }

    public function updateTransaction(Request $request)
    {
        
        $transaction_id = $request->input('transaction_id');
        $payment_status = $request->input('payment_status');

        if (in_array($payment_status, ['Completed', 'Failed'])) {
            DB::table('transaction')->where('transaction_id', $transaction_id)->update([
                'payment_status' => $payment_status
            ]);

            if ($payment_status === 'Completed') {
                $items = DB::table('transaction_item')->where('transaction_id', $transaction_id)->get();
                foreach ($items as $item) {
                    DB::table('product')
                        ->where('product_id', $item->product_id)
                        ->decrement('stock', $item->quantity);
                    
                    $stock = DB::table('product')->where('product_id', $item->product_id)->value('stock');
                    if ($stock == 0) {
                        DB::table('product')->where('product_id', $item->product_id)->update([
                            'status' => 'Out of Stock'
                        ]);
                    }
                }
            }

            Session::flash('message_transaction', 'Transaction status updated successfully.');
        }

        return redirect()->to(url('/store-management') . '#manageTransactions');
    }
}
