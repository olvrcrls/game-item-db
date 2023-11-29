<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GameResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [];
        foreach ($this->collection as $game) {
            $data[] = [
                'uuid' => $game->uuid,
                'name' => $game->name,
                'description' => $game->description,
                // If the user requesting the data has a role of admin, include the following fields
                // 'created_at' => $game->created_at,
                // 'updated_at' => $game->updated_at,
            ];
        }
        return $data;
    }
}
