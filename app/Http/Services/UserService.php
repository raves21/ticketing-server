<?php

namespace App\Http\Services;

use App\Http\Repositories\UserRepository;
use App\Http\Resources\UserResource;

class UserService
{
    public function __construct(
        private UserRepository $userRepo
    ) {
    }

    public function getAll()
    {
        return UserResource::collection($this->userRepo->getAll());
    }

    public function findById(string $id)
    {
        return new UserResource($this->userRepo->findById($id));
    }

    public function create(array $payload)
    {
        $user = $this->userRepo->create($payload);
        $user->assignRole('user');
        return new UserResource($user->fresh());
    }

    public function updateById(string $id, array $payload)
    {
        return new UserResource($this->userRepo->updateById($id, $payload));
    }

    public function deleteById(string $id)
    {
        return $this->userRepo->deleteById($id);
    }
}
