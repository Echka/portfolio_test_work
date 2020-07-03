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

class BriefController extends Controller implements IGet, IDelete, IUpdate, ICreate
{

    public function get(Request $request, $id)
    {
        try {

            $brief = Brief::find($id);

            if ($brief == null)
                return $this->sendResponse('', 'Not Found', 404);
            else
                return $this->sendResponse($brief, 'OK', 200);

        } catch (QueryException $e) {
            return $this->sendError('Internal server Error', 500);
        }
    }

    public function getList(Request $request)
    {
        try {

            $briefs = Brief::where('user_id', Auth::user()->id)->get();

            if ($briefs == null)
                return $this->sendResponse('', 'No Content', 204);
            else
                return $this->sendResponse($briefs, 'OK', 200);

        } catch (QueryException $e) {
            return $this->sendError('Internal server Error', 500);
        }
    }

    public function destroy(Request $request, int $id)
    {
        try {

            if (Brief::destroy($id))
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

            $brief = Brief::where('id', $id)
                ->where('user_id', Auth::user()->id)
                ->first();

            if ($brief == null)
                return $this->sendResponse('', 'Not Found', 404);

            $data = $this->fillData($request);

            if ($brief->update($data))
                return $this->sendResponse($brief, 'OK', 200);
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

            $brief = Brief::create($data);

            if ($brief)
                return $this->sendResponse($brief, 'OK', 201);
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
