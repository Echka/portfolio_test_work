<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface ICreate
{

    public function store(Request $request);
    public function isValid(Request $request) : bool;
    public function fillData(Request $request) : array;
}