<?php

namespace rohsyl\OmegaCore\Models;

use Illuminate\Database\Eloquent\Model;

class MediaInformation extends Model
{

    protected $fillable = [
        'media_id',
        'locale',
        'title',
        'description',
    ];
}
