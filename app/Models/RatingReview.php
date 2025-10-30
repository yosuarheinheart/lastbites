<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingReview extends Model
{
    use HasFactory;

    protected $table = 'rating_review';
    public $timestamps = false;

    protected $fillable = [
        'transaction_id',
        'user_id',
        'product_id',
        'rating',
        'review',
    ];
}