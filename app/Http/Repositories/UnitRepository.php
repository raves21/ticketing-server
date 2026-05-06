<?php

namespace App\Http\Repositories;

use App\Models\Unit;
use App\Http\Repositories\BaseRepository;

class UnitRepository extends BaseRepository
{
    public function __construct(
        private Unit $unit
    ) {
        parent::__construct($unit);
    }

    public function isRootUnit(string $unitId)
    {
        return Unit::findOrFail($unitId)->parent_id === null;
    }

    public function getAllExceptOwn()
    {
        return Unit::whereNot('id', auth()->user()->unit_id)->get();
    }

    public function getRootUnitTree(Unit $rootUnit)
    {
        return $rootUnit->bloodline;
    }

    public function getMyUnits()
    {
        return Unit::whereHas('unitMembers', function ($query) {
            $query->where('user_id', auth()->id());
        })->get();
    }

    public function getRootUnitMembers(array $payload)
    {
        return Unit::findOrFail($payload['root_unit_id'])->rootUnitMembers()->paginate();
    }

    public function getUnitMembers(string $unitId)
    {
        return Unit::findOrFail($unitId)->unitMembers()->get();
    }
}
