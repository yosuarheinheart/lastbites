<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Store
{
    protected $table = 'stores';

    public function getProducts($storeId)
    {
        return DB::table('products')
            ->where('store_id', $storeId)
            ->get();
    }

    public function getTransactions($storeId)
    {
        return DB::table('transactions')
            ->where('store_id', $storeId)
            ->get();
    }
}
