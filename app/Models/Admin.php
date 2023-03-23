<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
	use Notifiable;

    protected $guard = 'admin';

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'first_name',
        'last_name',
        'userImage',
        'phone',
        'type',
        'userToken',
        'phone',
        'user_type',
    ];

    protected $hidden = [
        'password', 
        'remember_token',
    ];
}
