<?php

namespace App\Repositories;
use App\Base\BaseRepository;
use App\Http\Resources\{UserResource, UserResourceDatum};
use App\Models\User;

class UserRepository extends BaseRepository
{
    public function getModel(): User
    {
        return new User();
    }

    public function getResource(): string
    {
        return UserResource::class;
    }

    public function getResourceDatum(): string
    {
        return UserResourceDatum::class;
    }
}