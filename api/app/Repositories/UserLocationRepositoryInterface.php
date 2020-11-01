<?php

namespace App\Repositories;

interface UserLocationRepositoryInterface
{
    public function findByUserId(int $userId);

    public function findLastLocationByUserId(int $userId);

    public function store(array $userLocationData);
}
