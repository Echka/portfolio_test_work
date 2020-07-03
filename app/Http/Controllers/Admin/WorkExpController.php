<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\WorkExperience;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Interfaces\ICreate;
use App\Interfaces\IDelete;
use App\Interfaces\IGet;
use App\Interfaces\IUpdate;
use Illuminate\Database\QueryException;
use Carbon\Carbon;
use App\Traits\CRUD;

class WorkExpController extends Controller implements IGet, IDelete, IUpdate, ICreate
{

    use CRUD;

    public $model;

    public function __construct()
    {
        $this->model = new WorkExperience();
    }

    public function additionalCondition(Request $request, Builder $query)
    {
        $query->where('brief_id', $request['brief_id']);

        return $query;
    }

    public function isValid(Request $request) : bool
    {
        try {

            $request->validate([
                'date_start' => 'nullable',
                'date_finish' => 'nullable',
                'place_of_work' => 'max:50',
                'short_description' => 'max:200',
                'position' => 'max:50',
                'brief_id' => 'required'
            ]);

            return true;

        } catch (\Throwable $e) {
            report($e);

            return false;
        }
    }

    public function fillData(Request $request) : array
    {
        $dateStart = ($request['date_start'] ?? null)
            ? Carbon::parse($request['date_start'])
            : null;

        $dateFinish = ($request['date_finish'] ?? null)
            ? Carbon::parse($request['date_finish'])
            : null;

        return [
            'date_start' => $dateStart,
            'date_finish' => $dateFinish,
            'place_of_work' => $request['place_of_work'],
            'short_description' => $request['short_description'],
            'position' => $request['position'],
            'brief_id' => $request['brief_id']
        ];
    }
}
