<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\LangKnowledge;
use Illuminate\Http\Request;
use App\Interfaces\ICreate;
use App\Interfaces\IDelete;
use App\Interfaces\IGet;
use App\Interfaces\IUpdate;
use Illuminate\Database\QueryException;
use Carbon\Carbon;
use App\Traits\CRUD;
use Illuminate\Database\Eloquent\Builder;

class LangKnowledgeController extends Controller implements IGet, IDelete, IUpdate, ICreate
{

    use CRUD;

    public $model;

    public function __construct()
    {
        $this->model = new LangKnowledge();
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
                'language' => 'max:20',
                'level_lang' => 'max:20',
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
            'language' => $request['language'],
            'level_lang' => $request['level_lang'],
            'brief_id' => $request['brief_id']
        ];
    }
}
