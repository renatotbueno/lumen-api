<?php

namespace App\Http\Controllers;

use App\Services\UserLocationService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\LatLngInvalidException;
use App\Exceptions\UserLocationStoreException;

class UserLocationController extends Controller
{
    /**
     * @param UserLocationService $service
     */
    private $service;

    public function __construct(UserLocationService $service)
    {
        $this->service = $service;
    }

    public function getByUserId($userId) {
        return $this->service->findByUserId((int)$userId);
    }

    public function getLastLocationByUserId($userId) {
        return $this->service->findLastLocationByUserId((int)$userId);
    }

    public function store($userId, Request $request) {

        $validator = Validator::make($request->all(), 
            [
                'lat' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
                'lng' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/']
            ],
            [
                'lat.regex' => 'Latitude value appears to be incorrect format.',
                'long.regex' => 'Longitude value appears to be incorrect format.'
            ]
        );

        if ($validator->fails()) {
            throw new LatLngInvalidException('Invalid lat or Lng values.', 422, $validator->errors()->getMessages());
        }

        try { 
           $this->service->store((int)$userId, $request->input());
        } catch (\Exception $e) {
            throw new UserLocationStoreException($e->getMessage(), 500);
        }

        return response()->json(['success' => true, 'message' => 'Successful stored']);
        
    }
}
