<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\ProfessionalSkills;
use Illuminate\Http\Request;
use App\Interfaces\ICreate;
use App\Interfaces\IDelete;
use App\Interfaces\IGet;
use App\Interfaces\IUpdate;
use Illuminate\Database\QueryException;
use Carbon\Carbon;
use App\Traits\CRUD;
use Illuminate\Database\Eloquent\Builder;

class ProfSkillController extends Controller implements IGet, IDelete, IUpdate, ICreate
{

    use CRUD;

    public $model;

    public function __construct()
    {
        $this->model = new ProfessionalSkills();
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
                'type_skill' => 'max:100',
                'description_skill' => 'nullable',
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
        return [
            'type_skill' => $request['type_skill'],
            'description_skill' => $request['description_skill'],
            'brief_id' => $request['brief_id']
        ];
    }
}
