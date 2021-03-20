<?php

namespace rohsyl\OmegaCore\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'parent_id',
        'author_id',
        'menu_id',
        'slug',
        'title',
        'subtitle',
        'show_title',
        'show_subtitle',
        'keywords',
        'model',
        'order',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime'
    ];

    public function author(){
        return $this->belongsTo(User::class, 'author_id');
    }

    public function parent(){
        return $this->belongsTo(Page::class, 'parent_id');
    }

    public function children(){
        return $this->hasMany(Page::class, 'parent_id');
    }

    public function components(){
        return $this->hasMany(Component::class)->where('is_widget', false);
    }

    public function widgets(){
        return $this->hasMany(Component::class)->where('is_widget', true);
    }

    public function security(){
        return $this->hasOne(PageSecurity::class);
    }
}
