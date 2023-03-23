<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Userpackage extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'userId',
        'purchasePack',
        'transactionId',
        'amount',
        'purchaseDate',
    ];
}
