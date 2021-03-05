<?php

namespace rohsyl\OmegaCore\Models;

use Illuminate\Database\Eloquent\Model;
use Omega\Utils\Plugin\PluginMeta;

class Plugin extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'parent_id',
        'name',
        'is_enabled',
    ];
}
