<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Unit\GetRootUnitMembers;
use App\Http\Requests\Unit\GetRootUnitTree;
use App\Http\Requests\Unit\GetUnitMembers;
use App\Http\Requests\Unit\Index;
use App\Http\Requests\Unit\Store;
use App\Http\Requests\Unit\Update;
use App\Http\Services\UnitService;

class UnitController extends Controller
{
    public function __construct(
        private UnitService $unitService
    ) {
    }

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

    public function getMyUnits()
    {
        return $this->unitService->getMyUnits();
    }

    public function getRootUnits()
    {
        return $this->unitService->getRootUnits();
    }

    public function getRootUnitTree(GetRootUnitTree $request)
    {
        return $this->unitService->getRootUnitTree($request->validated());
    }

    public function getRootUnitMembers(GetRootUnitMembers $request)
    {
        return $this->unitService->getRootUnitMembers($request->validated());
    }

    public function getUnitMembers(GetUnitMembers $request)
    {
        return $this->unitService->getUnitMembers($request->validated());
    }
}
