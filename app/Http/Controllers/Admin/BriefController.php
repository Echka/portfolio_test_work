<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\ICreate;
use App\Interfaces\IDelete;
use App\Interfaces\IGet;
use App\Interfaces\IUpdate;
use App\Model\Brief;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\CRUD;
use Illuminate\Database\Eloquent\Builder;

class BriefController extends Controller implements IGet, IDelete, IUpdate, ICreate
{

    use CRUD;

    public $model;

    public function __construct()
    {
        $this->model = new Brief();
    }

    public function additionalCondition(Request $request, Builder $query)
    {
        $query->where('user_id', Auth::user()->id);

        return $query;
    }

    public function isValid(Request $request) : bool
    {
        try {

            $request->validate([
                'position' => 'required|max:50',
                'salary' => 'required|int',
                'city' => 'required|max:20',
                'additional_info' => 'nullable'
            ]);

            return true;

        } catch (\Throwable $e) {
            report($e);

            return false;
        }
    }

    public function fillData(Request $request) : array
    {
        return [
            'position' => $request['position'],
            'salary' => $request['salary'],
            'city' => $request['city'],
            'additional_info' => $request['additional_info'],
            'user_id' => Auth::user()->id
        ];
    }
}
