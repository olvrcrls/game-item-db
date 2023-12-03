<?php

namespace App\Repositories;
use App\Base\BaseRepository;
use App\Http\Resources\ItemResource;
use App\Http\Resources\ItemResourceDatum;
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

    /**
     * Returns the resource class.
     */
    public function getResource(): string
    {
        return ItemResource::class;
    }

    public function getResourceDatum(): string
    {
        return ItemResourceDatum::class;
    }
}