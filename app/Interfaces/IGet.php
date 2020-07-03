<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface IGet
{

    public function get(Request $request, $id);
    public function getList(Request $request);
}