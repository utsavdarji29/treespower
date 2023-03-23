<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Jobimage extends Authenticatable
{
	use Notifiable;

    

    protected $fillable = [
        'job_id',
        'job_image',
    ];

}
