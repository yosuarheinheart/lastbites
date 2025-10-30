<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user';
    public $timestamps = false;
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'gender',
        'date_of_birth',
        'profile_picture',
        'user_role',
        'siup',
        'registration_date',
        'account_status',
        'admin_notes',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

}