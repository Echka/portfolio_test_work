<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface IGet
{

    public function get(Request $request);
}