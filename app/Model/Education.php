<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{

    public $timestamps = false;
    protected $fillable = [
        'date_start',
        'date_finish',
        'specialty',
        'city',
        'type_of_education',
        'brief_id'
    ];
}
