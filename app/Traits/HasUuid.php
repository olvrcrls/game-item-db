<?php
declare(strict_types=1);

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
trait HasUuid
{
    public static function bootHasUuid(): void
    {
        static::creating(function (Model $model) {
                if (!$model->uuid) {
                    $model->uuid = app()->environment('testing', 'test') ? 'test' : Str::uuid();
                }
            }
        );
    }

    /**
     * Route key name for implicit route binding.
     */
    public function getRouteKeyName(): string
    {
        return 'uuid';
    }
}