<?php

namespace App\Services;

use \DB;
use App\Services\UserLocationRedisService;
use App\Models\UserLocation;
use App\Http\Resources\UserLocationResource;
use App\Repositories\UserLocationRepositoryInterface;

class UserLocationService
{
    /**
     * @param UserLocationRepositoryInterface $repository
     */
    private $repository;

    public function __construct(UserLocationRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function findByUserId($userId) {
        $locations = $this->repository->findByUserId($userId);
        return UserLocationResource::collection($locations);
    }

    public function findLastLocationByUserId($userId) {

        $location = $this->repository->findLastLocationByUserId($userId);
        return UserLocationResource::collection($location);
    }

    public function store($userId, $userLocationData) {

        $userLocationData['user_id'] = $userId;
        $userLocationData['created_at'] =(new \Datetime())->format('Y-m-d H:i:s');
        $userLocation =  $this->repository->store($userLocationData);
    }
}
