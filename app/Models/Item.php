<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'attributes' => 'array'
    ];

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }
}
