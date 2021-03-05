<?php

namespace rohsyl\OmegaCore\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Theme extends Model
{
    use SoftDeletes;


    protected $fillable = [
        'name',
        'title',
        'description',
        'website',
        'param',
    ];

    protected $casts = [
        'param' => 'array'
    ];
}
