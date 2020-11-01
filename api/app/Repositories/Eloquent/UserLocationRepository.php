<?php

namespace App\Repositories\Eloquent;

use \DB;
use App\Models\UserLocation;
use App\Repositories\UserLocationRepositoryInterface;

class UserLocationRepository implements UserLocationRepositoryInterface
{
    public function findByUserId(int $userId) {

       return DB::table('user_locations')
            ->where('user_id', $userId)
            ->get();
    }

    public function findLastLocationByUserId($userId) {

        return DB::table('user_locations')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->limit(1)
            ->get();
    }

    public function store($userLocationData) {
        return UserLocation::create($userLocationData);
    }
}
