<?php

namespace App\Http\Services;

use App\Http\Repositories\UnitRepository;
use App\Http\Resources\UnitResource;
use App\Http\Resources\UserResource;
use Illuminate\Support\Arr;

class UnitService
{
    public function __construct(
        private UnitRepository $unitRepo
    ) {
    }

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

    public function getRootUnits(array $payload)
    {
        return UnitResource::collection(
            $this->unitRepo->getAll(
                filters: ['parent_id' => null],
                paginate: Arr::get($payload, 'paginate', false)
            ),
        );
    }

    public function getRootUnitTree(array $payload)
    {
        if (!$this->unitRepo->isRootUnit($payload['root_unit_id'])) {
            abort(400, 'Given id is not a root unit.');
        }
        $rootUnit = $this->unitRepo->findById($payload['root_unit_id']);

        return UnitResource::collection($this->unitRepo->getRootUnitTree($rootUnit));
    }

    public function getMyUnits()
    {
        return UnitResource::collection($this->unitRepo->getMyUnits());
    }

    public function getRootUnitMembers(array $payload)
    {
        if (!$this->unitRepo->isRootUnit($payload['root_unit_id'])) {
            abort(400, 'Given id is not a root unit.');
        }
        return UserResource::collection($this->unitRepo->getRootUnitMembers($payload));
    }

    public function getUnitMembers(string $unitId)
    {
        return UserResource::collection($this->unitRepo->getUnitMembers($unitId));
    }
}
