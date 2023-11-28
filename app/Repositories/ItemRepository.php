<?php

namespace App\Repositories;
use App\Base\BaseRepository;
use App\Models\Item;

class ItemRepository extends BaseRepository
{
    /**
     * Returns the model class.
     */
    public function getModel(): Item
    {
        return new Item();
    }
}