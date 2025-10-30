<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProductUpdate extends Controller {
    public function edit($product_id) {

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

        $product = DB::table('product')->where('product_id', $product_id)->first();
        
        if (!$product) {
            return redirect()->route('store.management')->with('error', 'Product not found.');
        }

        return view('product_update', compact('user', 'isSeller', 'ownStore', 'product'));
    }

    public function update(Request $request, $product_id) {

        $product = DB::table('product')->where('product_id', $product_id)->first();

        if (!$product) {
            return redirect()->route('store.management')->with('error', 'Product not found.');
        }

        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'status' => 'required|in:Available,Out of Stock',
            'product_picture' => 'nullable|image|max:2048',
        ]);

        $product_picture_path = null;

        if ($request->hasFile('product_picture')) {
            $file = $request->file('product_picture');
            $product_picture_path = 'upload/product/' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/product'), $product_picture_path);
        }

        $updateData = [
            'product_name' => $request->input('product_name'),
            'product_description' => $request->input('product_description'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'status' => $request->input('status')
        ];

        if ($product_picture_path) {
            $updateData['product_picture'] = $product_picture_path;
        }

        DB::table('product')->where('product_id', $product_id)->update($updateData);

        Session::flash('message_manage_product', 'Product updated successfully.');
        return redirect()->to(url('/store-management') . '#manageProducts');
    }

    public function delete($product_id) {
        $product = DB::table('product')->where('product_id', $product_id)->first();
        if (!$product) {
            return redirect()->route('store_management')->with('error', 'Product not found.');
        }

        if ($product->product_picture && Storage::exists($product->product_picture)) {
            Storage::delete($product->product_picture);
        }

        DB::table('product')->where('product_id', $product_id)->delete();

        Session::flash('message_manage_product', 'Product deleted successfully.');
        return redirect()->to(url('/store-management') . '#manageProducts');

    }


}