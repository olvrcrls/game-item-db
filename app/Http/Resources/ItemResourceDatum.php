<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResourceDatum extends JsonResource
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
            'image' => $this->image,
            'type' => $this->type,
            'level' => $this->level,
            'rarity' => $this->rarity,
            'description' => $this->description,
            'attributes' => $this->attributes,
            'deprecated' => $this->deprecated,
            'available' => $this->deprecated,
        ];
    }
}
