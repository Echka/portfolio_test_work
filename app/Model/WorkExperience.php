<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{

    protected $fillable = [
        'date_start',
        'date_finish',
        'place_of_work',
        'short_description',
        'position',
        'brief_id'
    ];
}
