<?php

namespace App\Repositories;

use App\Base\BaseRepository;
use App\Models\Game;

class GameRepository extends BaseRepository
{
    public function getModel(): Game
    {
        return new Game();
    }
}