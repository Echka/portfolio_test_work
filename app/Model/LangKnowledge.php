<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LangKnowledge extends Model
{

    public $timestamps = false;
    protected $fillable = [
        'language',
        'level_lang',
        'brief_id'
    ];
}
