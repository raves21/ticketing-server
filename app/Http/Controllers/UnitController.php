<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Unit\Index;
use App\Http\Requests\Unit\Store;
use App\Http\Requests\Unit\Update;
use App\Http\Services\UnitService;

class UnitController extends Controller
{
    public function __construct(
        private UnitService $unitService
    ) {}

    public function index(Index $request)
    {
        return $this->unitService->getAll($request->validated());
    }

    public function store(Store $request)
    {
        return $this->unitService->create($request->validated());
    }

    public function show(string $id)
    {
        return $this->unitService->findById($id);
    }

    public function update(Update $request, string $id)
    {
        return $this->unitService->updateById($id, $request->validated());
    }

    public function destroy(string $id)
    {
        return $this->unitService->deleteById($id);
    }
}
