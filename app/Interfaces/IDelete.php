<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface IDelete
{

    public function destroy(Request $request, int $id);
}