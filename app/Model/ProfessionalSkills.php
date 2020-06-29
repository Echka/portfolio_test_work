<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProfessionalSkills extends Model
{

    public $timestamps = false;
    protected $fillable = [
        'type_skill',
        'description_skill',
        'brief_id'
    ];
}
