<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Transaction
{
    protected $table = 'transactions';

    public function getStore($transactionId)
    {
        return DB::table('stores')
            ->join('transactions', 'stores.store_id', '=', 'transactions.store_id')
            ->where('transactions.id', $transactionId)
            ->first();
    }

    public function getItems($transactionId)
    {
        return DB::table('transaction_items')
            ->where('transaction_id', $transactionId)
            ->get();
    }

    public function getReview($transactionId)
    {
        return DB::table('rating_reviews')
            ->where('transaction_id', $transactionId)
            ->first();
    }
}
