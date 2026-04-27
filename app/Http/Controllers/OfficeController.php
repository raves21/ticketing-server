<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Office\Index;
use App\Http\Requests\Office\Store;
use App\Http\Requests\Office\Update;
use App\Http\Services\OfficeService;

class OfficeController extends Controller
{
    public function __construct(
        private OfficeService $officeService
    ) {
    }

    public function index(Index $request)
    {
        return $this->officeService->getAll($request->validated());
    }

    public function store(Store $request)
    {
        return $this->officeService->create($request->validated());
    }

    public function show(string $id)
    {
        return $this->officeService->findById($id);
    }

    public function update(Update $request, string $id)
    {
        return $this->officeService->updateById($id, $request->validated());
    }

    public function destroy(string $id)
    {
        return $this->officeService->deleteById($id);
    }
}
