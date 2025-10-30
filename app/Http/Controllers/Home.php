<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Home extends Controller
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

        $userStores = DB::table('store')
            ->join('transaction', 'store.store_id', '=', 'transaction.store_id')
            ->select('store.store_id', 'store.store_name', 'store.store_picture')
            ->where('transaction.user_id', $user_id)
            ->where('transaction.payment_status', '=', 'completed')
            ->distinct()
            ->limit(8)
            ->get();

        $popularStores = DB::table('store')
            ->join('transaction', 'store.store_id', '=', 'transaction.store_id')
            ->select('store.store_id', 'store.store_name', 'store.store_picture', DB::raw('COUNT(transaction.transaction_id) AS transaction_count'))
            ->groupBy('store.store_id', 'store.store_name', 'store.store_picture')
            ->orderByDesc('transaction_count')
            ->limit(4)
            ->get();

        $categories = DB::table('category')
            ->select('category_id', 'category_name', 'category_picture')
            ->get();

        return view('home', [
            'user' => $user, 
            'ownStore' => $ownStore, 
            'isSeller' => $isSeller,
            'userStores' => $userStores,
            'popularStores' => $popularStores,
            'categories' => $categories
        ]);
    }

    public function showCategory()
    {   
        $categories = DB::table('category')
            ->select('category_id', 'category_name', 'category_picture')
            ->get();

        return view('category', ['categories' => $categories]);
    }

    public function openCategory($categoryId)
    {
        $user_id = Session::get('user_id');

        $category = DB::table('category')
            ->select('category_name')
            ->where('category_id', $categoryId)
            ->first();

        if (!$category) {
            return redirect()->route('home')->withErrors(['Category not found.']);
        }

        $stores = DB::table('store')
            ->distinct()
            ->select('store.store_id', 'store.store_name', 'store.address', 'store.average_rating', 'store.status', 'store.store_picture')
            ->join('product', 'store.store_id', '=', 'product.store_id')
            ->where('product.category_id', $categoryId)
            ->get();

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

        return view('category', [
            'categoryName' => $category->category_name,
            'stores' => $stores,
            'user' => $user, 
            'ownStore' => $ownStore, 
            'isSeller' => $isSeller
        ]);
    }

    public function guest() {
        return view('guest');
    }
    public function learnMore()
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

        return view('learnmore', [
            'user' => $user,
            'isSeller' => $isSeller,
            'ownStore' => $ownStore
        ]);
    }
}