<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface IUpdate
{

    public function update(Request $request, int $id);
    public function isValid(Request $request) : bool;
    public function fillData(Request $request) : array;
}