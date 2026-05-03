<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'role' => $this->roles->first()->name,
            'unit' => new UnitResource($this->whenLoaded('unit')),
            $this->mergeWhen(
                $this->unit,
                fn() => ['root_unit' => new UnitResource($this->unit->bloodline->first(fn($unit) => $unit->parent_id === null))]
            ),
            $this->mergeWhen(
                $this->additional && $this->additional['with_permissions'],
                fn() => ['permissions' => $this->getAllPermissions()->pluck('name')]
            )
        ];
    }
}
