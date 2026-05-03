<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // dd($this->creator->roles->first());
        return [
            'id' => $this->id,
            'code' => $this->code,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'priority_level' => $this->priority_level,
            'creator' => new UserResource($this->whenLoaded('creator')),
            'sender_unit' => new UnitResource($this->whenLoaded('senderUnit')),
            'recipient_unit' => new UnitResource($this->whenLoaded('recipientUnit')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
