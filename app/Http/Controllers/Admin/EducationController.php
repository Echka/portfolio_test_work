<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Education;
use Illuminate\Http\Request;
use App\Interfaces\ICreate;
use App\Interfaces\IDelete;
use App\Interfaces\IGet;
use App\Interfaces\IUpdate;
use Illuminate\Database\QueryException;
use Carbon\Carbon;
use App\Traits\CRUD;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;


class EducationController extends Controller implements IGet, IDelete, IUpdate, ICreate
{

    use CRUD;

    public $model;

    public function __construct()
    {
        $this->model = new Education();
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
                'title' => 'max:100',
                'date_start' => 'nullable',
                'date_finish' => 'nullable',
                'specialty' => 'max:50',
                'city' => 'max:20',
                'type_of_education' => 'max:20'
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
            'title' => $request['title'],
            'specialty' => $request['specialty'],
            'city' => $request['city'],
            'type_of_education' => $request['type_of_education'],
            'brief_id' => $request['brief_id']
        ];
    }
}
