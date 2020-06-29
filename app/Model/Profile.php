<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    public $timestamps = false;
    protected $fillable = [
        'fio',
        'date_of_birth',
        'city',
        'address',
        'phone',
        'email',
        'user_id'
    ];
}
