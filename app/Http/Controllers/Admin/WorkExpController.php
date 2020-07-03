<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\WorkExperience;
use Illuminate\Http\Request;
use App\Interfaces\ICreate;
use App\Interfaces\IDelete;
use App\Interfaces\IGet;
use App\Interfaces\IUpdate;
use Illuminate\Database\QueryException;
use Carbon\Carbon;

class WorkExpController extends Controller implements IGet, IDelete, IUpdate, ICreate
{

    public function get(Request $request, $id)
    {
        try {

            $experience = WorkExperience::find($id);

            if ($experience == null)
                return $this->sendResponse('', 'Not Found', 404);
            else
                return $this->sendResponse($experience, 'OK', 200);

        } catch (QueryException $e) {
            return $this->sendError('Internal server Error', 500);
        }
    }

    public function getList(Request $request)
    {
        try {

            $experiences = WorkExperience::where('brief_id', $request['brief_id'])->get();

            if ($experiences == null)
                return $this->sendResponse('', 'No Content', 204);
            else
                return $this->sendResponse($experiences, 'OK', 200);

        } catch (QueryException $e) {
            return $this->sendError('Internal server Error', 500);
        }
    }

    public function destroy(Request $request, int $id)
    {
        try {

            if (WorkExperience::destroy($id))
                return $this->sendResponse('', 'OK', 200);
            else
                return $this->sendResponse('', 'Not Modified', 304);

        } catch (QueryException $e) {
            return $this->sendError('Internal server Error', 500);
        }
    }

    public function update(Request $request, int $id)
    {
        if ($this->isValid($request) == false)
            return $this->sendError('Bad Request', 400);

        try {

            $experience = WorkExperience::where('id', $id)
                ->first();

            if ($experience == null)
                return $this->sendResponse('', 'Not Found', 404);

            $data = $this->fillData($request);

            if ($experience->update($data))
                return $this->sendResponse($experience, 'OK', 200);
            else
                return $this->sendResponse('', 'Not Modified', 304);

        } catch (QueryException $e) {
            return $this->sendError('Internal server Error', 500);
        }
    }

    public function store(Request $request)
    {
        if ($this->isValid($request) == false)
            return $this->sendError('Bad Request', 400);

        try {

            $data = $this->fillData($request);

            $experience = WorkExperience::create($data);

            if ($experience)
                return $this->sendResponse($experience, 'OK', 201);
            else
                return $this->sendResponse('', 'Not Modified', 304);

        } catch (QueryException $e) {

            return $this->sendError('Internal server Error', 500);
        }
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
