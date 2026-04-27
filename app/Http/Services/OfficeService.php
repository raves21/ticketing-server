<?php

namespace App\Http\Services;

use App\Http\Repositories\OfficeRepository;
use App\Http\Resources\OfficeResource;
use Arr;

class OfficeService
{
    public function __construct(
        private OfficeRepository $officeRepo
    ) {
    }

    public function getAll(array $payload)
    {
        $exceptOwn = Arr::get($payload, 'except_own', false);

        if ($exceptOwn) {
            return OfficeResource::collection($this->officeRepo->getAllExceptOwn());
        }
        return OfficeResource::collection($this->officeRepo->getAll(paginate: false));
    }

    public function findById(string $id)
    {
        return new OfficeResource($this->officeRepo->findById($id));
    }

    public function create(array $payload)
    {
        return new OfficeResource($this->officeRepo->create($payload));
    }

    public function updateById(string $id, array $payload)
    {
        return new OfficeResource($this->officeRepo->updateById($id, $payload));
    }

    public function deleteById(string $id)
    {
        return $this->officeRepo->deleteById($id);
    }
}
