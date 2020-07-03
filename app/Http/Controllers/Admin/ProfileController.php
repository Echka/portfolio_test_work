<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\ICreate;
use App\Interfaces\IGet;
use App\Interfaces\IUpdate;
use App\Model\Profile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use App\Traits\CRUD;
use Illuminate\Database\Eloquent\Builder;

class ProfileController extends Controller implements IGet, IUpdate, ICreate
{

    use CRUD;

    public $model;

    public function __construct()
    {
        $this->model = new Profile();
    }

    public function get(Request $request, $id = null)
    {
        try {

            $data = Auth::user()->profile;

            if ($data == null)
                $data = $this->store($request);

            if ($data)
                return $this->sendResponse($data, 'OK', 200);
            else
                return $this->sendResponse('', 'Not Found', 404);

        } catch (QueryException $e) {
            return $this->sendError('Internal server Error', 500);
        }
    }

    public function getByUser(Request $request, int $user_id)
    {
        try {

            $profile = Profile::where('user_id', $user_id)->first();

            if ($profile)
                return $this->sendResponse($profile, 'OK', 200);
            else
                return $this->sendResponse('', 'Not Found', 404);

        } catch (QueryException $e) {
            return $this->sendError('Internal server Error', 500);
        }
    }

    public function store(Request $request)
    {
        try {

            $data = $this->fillData($request);

            $profile = Profile::create($data);

            return $profile;

        } catch (QueryException $e) {
            return $this->sendError('Internal server Error', 500);
        }
    }

    public function update(Request $request, int $id)
    {
        if ($this->isValid($request) == false)
            return $this->sendError('Bad Request', 400);

        try {

            $profile = Profile::where('id', $id)
                ->where('user_id', Auth::user()->id)
                ->first();

            if ($profile == null)
                return $this->sendResponse('', 'Not Found', 404);

            $data = $this->fillData($request);

            if ($profile->update($data))
                return $this->sendResponse($profile, 'OK', 200);
            else
                return $this->sendResponse('', 'Not Modified', 304);

        } catch (QueryException $e) {
            return $this->sendError('Internal server Error', 500);
        }
    }

    public function fillData(Request $request): array
    {
        $dateOfBirth = ($request['date_of_birth'] ?? null)
            ? Carbon::parse($request['date_of_birth'])
            : null;

        return [
            'fio' => $request['fio'] ?? '',
            'date_of_birth' => $dateOfBirth,
            'city' => $request['city'] ?? '',
            'address' => $request['address'] ?? '',
            'phone' => $request['phone'] ?? '',
            'email' => $request['email'] ?? '',
            'user_id' => Auth::user()->id
        ];
    }

    public function isValid(Request $request): bool
    {
        try {

            $request->validate([
                'fio' => 'max:70',
                'date_of_birth' => 'nullable',
                'city' => 'max:20',
                'address' => 'max:70',
                'phone' => 'max:20',
                'email' => 'max:30'
            ]);

            return true;

        } catch (\Throwable $e) {
            report($e);

            return false;
        }
    }
}
