<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chunadmin extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $guard = 'chunadmin';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //protected $guard = 'manager';

     protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'userImage',
        'type',
        'userToken',
        'phone',
        'user_type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
