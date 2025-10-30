<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admins extends model {
    use HasFactory;

    protected $table = 'admin';

    protected $fillable = [
        'email',
        'password',
        'admin_name',
    ];
}