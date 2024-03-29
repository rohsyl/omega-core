<?php

namespace rohsyl\OmegaCore\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use rohsyl\OmegaCore\Utils\Overt\Page\OvertPageTrait;

class Page extends Model
{
    use SoftDeletes;
    use OvertPageTrait;

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

    protected $attributes = [
        'show_title' => true,
        'show_subtitle' => true,
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
        return $this->hasMany(Component::class)
            ->orderBy('order', 'ASC')
            ->where('is_widget', false);
    }

    public function widgets(){
        return $this->hasMany(Component::class)
            ->orderBy('order', 'ASC')
            ->where('is_widget', true);
    }

    public function security(){
        return $this->hasOne(PageSecurity::class);
    }

    public function scopePublished($query) {
        return $query->whereNotNull('published_at')->where('published_at', '<=', now());
    }

    public function getIsPublishedAttribute() {
        return isset($this->published_at) && $this->published_at->isBefore(now());
    }

    public function getUrlAttribute() {
        // TODO : generate url correctly
        return '/' . $this->slug;
    }
}
