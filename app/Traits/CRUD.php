<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 03.07.20
 * Time: 14:06
 */

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;


trait CRUD
{

    public function additionalCondition(Request $request, Builder $query)
    {
        return $query;
    }

    public function get(Request $request, $id)
    {
        try {

            $object = $this->model->find($id);

            if ($object == null)
                return $this->sendResponse('', 'Not Found', 404);
            else
                return $this->sendResponse($object, 'OK', 200);

        } catch (QueryException $e) {
            return $this->sendError('Internal server Error', 500);
        }
    }

    public function getList(Request $request)
    {
        try {

            $objects = $this->model->query();

            $objects = $this->additionalCondition($request, $objects)->get();

            if ($objects == null)
                return $this->sendResponse('', 'No Content', 204);
            else
                return $this->sendResponse($objects, 'OK', 200);

        } catch (QueryException $e) {
            return $this->sendError('Internal server Error', 500);
        }
    }

    public function destroy(Request $request, int $id)
    {
        try {

            if ($this->model->destroy($id))
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

            $object = $this->model->query()
                ->where('id', $id)
                ->first();

            if ($object == null)
                return $this->sendResponse('', 'Not Found', 404);

            $data = $this->fillData($request);

            if ($object->update($data))
                return $this->sendResponse($object, 'OK', 200);
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

            $object = $this->model->query()
                ->create($data);

            if ($object)
                return $this->sendResponse($object, 'OK', 201);
            else
                return $this->sendResponse('', 'Not Modified', 304);

        } catch (QueryException $e) {

            return $this->sendError('Internal server Error', 500);
        }
    }
}