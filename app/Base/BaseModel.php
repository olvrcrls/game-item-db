<?php

namespace App\Base;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    /**
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];
}