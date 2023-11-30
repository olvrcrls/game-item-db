<?php

namespace App\Repositories;

use App\Base\BaseRepository;
use App\Http\Resources\GameResource;
use App\Http\Resources\GameResourceDatum;
use App\Models\Game;

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

    public function getResourceDatum(): string
    {
        return GameResourceDatum::class;
    }
}