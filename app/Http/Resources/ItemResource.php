<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'name' => ucwords($this->name),
            'description' => $this->description,
            'image' => $this->image,
            'attributes' => $this->attributes,
            'type' => $this->type,
            'rarity' => $this->rarity,
            'level' => $this->level,
            'deprecated' => $this->deprecated,
            'game' => new GameResource($this->game),
            'created_at' => $this->created_at
        ];
    }
}
