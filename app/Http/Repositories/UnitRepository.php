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

    public function getAllExceptOwn()
    {
        return Unit::whereNot('id', auth()->user()->unit_id)->get();
    }
}
