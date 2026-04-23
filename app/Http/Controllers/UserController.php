<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Store;
use App\Http\Requests\User\Update;
use App\Http\Services\UserService;

class UserController extends Controller
{
    public function __construct(
        private UserService $userService
    ) {}

    public function index()
    {
        return $this->userService->getAll();
    }

    public function store(Store $request)
    {
        return $this->userService->create($request->validated());
    }

    public function show(string $id)
    {
        return $this->userService->findById($id);
    }

    public function update(Update $request, string $id)
    {
        return $this->userService->updateById($id, $request->validated());
    }

    public function destroy(string $id)
    {
        return $this->userService->deleteById($id);
    }
}
