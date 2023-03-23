<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Manager extends Authenticatable
{
    use Notifiable;

    protected $guard = 'manager';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'managerImage',
        'token',
        'phone',
        'user_type'
    ];

 
}

