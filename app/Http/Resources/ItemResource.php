<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ItemResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [];
        foreach ($this->collection as $item) {
            $data[] = [
                'uuid' => $item->uuid,
                'name' => ucwords($item->name),
                'description' => $item->description,
                'image' => $item->image,
                'attributes' => $item->attributes,
                'type' => $item->type,
                'rarity' => $item->rarity,
                'level' => $item->level,
                'deprecated' => $item->deprecated,
                'game' => new GameResourceDatum($item->game),
                // If the user requesting the data has a role of admin, include the following fields
                // 'created_at' => $item->created_at,
                // 'updated_at' => $item->updated_at,
            ];
        }

        return $data;
    }
}
