<?php
declare(strict_types=1);

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
trait HasUuid
{
    public static function bootHasUuid(): void
    {
        static::creating(fn (Model $model) =>
            $model->uuid = Str::uuid(),
        );
    }
}