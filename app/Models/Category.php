<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Category extends Authenticatable
{
	use Notifiable;

   

    protected $fillable = [
        'category_title'
    ];

  
}
