<?php

namespace rohsyl\OmegaCore\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Omega\Utils\Plugin\PluginMeta;

class Plugin extends Model
{
    protected $fillable = [
        'parent_id',
        'name',
        'is_enabled',
    ];


    public function plugin_forms() {
        return $this->hasMany(PluginForm::class);
    }

    protected static function booted()
    {
        static::deleting(function ($plugin_form) {
            foreach($plugin_form->plugin_forms as $form) {
                $form->delete();
            }
        });
    }
}
