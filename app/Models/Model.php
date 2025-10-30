<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $table = 'store';
    protected $primaryKey = 'store_id';
    protected $fillable = ['store_name', 'store_picture', 'address', 'status', 'store_description'];
}
