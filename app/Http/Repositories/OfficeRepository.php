<?php

namespace App\Http\Repositories;

use App\Models\Office;
use App\Http\Repositories\BaseRepository;

class OfficeRepository extends BaseRepository
{
    public function __construct(
        private Office $office
    ) {
        parent::__construct($office);
    }

    public function getAllExceptOwn()
    {
        return Office::whereNot('id', auth()->user()->office_id)->get();
    }
}
