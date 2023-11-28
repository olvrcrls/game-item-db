<?php

namespace App\Repositories;

use App\Base\BaseRepository;
use App\Http\Resources\GameResource;
use App\Models\Game;
use Illuminate\Http\Resources\Json\JsonResource;

class GameRepository extends BaseRepository
{
    public function getModel(): Game
    {
        return new Game();
    }

    public function getResource(): string
    {
        return GameResource::class;
    }
}