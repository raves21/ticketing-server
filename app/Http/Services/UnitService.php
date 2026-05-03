<?php

namespace App\Http\Services;

use App\Http\Repositories\UnitRepository;
use App\Http\Resources\UnitResource;
use Illuminate\Support\Arr;

class UnitService
{
    public function __construct(
        private UnitRepository $unitRepo
    ) {}

    public function getAll(array $payload)
    {
        $exceptOwn = Arr::get($payload, 'except_own', false);

        if ($exceptOwn) {
            return UnitResource::collection($this->unitRepo->getAllExceptOwn());
        }
        return UnitResource::collection($this->unitRepo->getAll(paginate: false));
    }

    public function findById(string $id)
    {
        return new UnitResource($this->unitRepo->findById($id));
    }

    public function create(array $payload)
    {
        return new UnitResource($this->unitRepo->create($payload));
    }

    public function updateById(string $id, array $payload)
    {
        return new UnitResource($this->unitRepo->updateById($id, $payload));
    }

    public function deleteById(string $id)
    {
        return $this->unitRepo->deleteById($id);
    }
}
