<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class TransactionItem
{
    protected $table = 'transaction_items';

    public function getTransactionItems($transactionId)
    {
        return DB::table($this->table)
            ->where('transaction_id', $transactionId)
            ->get();
    }

    public function getTransaction($transactionItemId)
    {
        return DB::table('transactions')
            ->join($this->table, 'transactions.id', '=', 'transaction_items.transaction_id')
            ->where('transaction_items.id', $transactionItemId)
            ->first();
    }

    public function getProduct($transactionItemId)
    {
        return DB::table('products')
            ->join($this->table, 'products.id', '=', 'transaction_items.product_id')
            ->where('transaction_items.id', $transactionItemId)
            ->first();
    }
}
