<?php

namespace App\Repositories;

use App\Base\BaseRepository;
use App\Http\Resources\GameResource;
use App\Models\Game;

class GameRepository extends BaseRepository
{
    public function getModel(): Game
    {
        return new Game();
    }

    /**
     * @param array<string> $columns
     * @return GameResource
     */
    public function all($columns = '*'): GameResource
    {
        $data = $this->model->all($columns);
        return new GameResource($data);
    }
}