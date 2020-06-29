<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Brief extends Model
{

    protected $fillable = [
        'position',
        'salary',
        'city',
        'additional_info',
        'user_id'
    ];
}
