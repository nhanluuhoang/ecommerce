<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;

class Category extends BaseModel
{
    use Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'sort_order',
        'is_public',
    ];

    protected $casts = [
        'is_public' => 'boolean'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * Scope is_public
     *
     * @param $query
     * @return mixed
     */
    public function scopeIsPublic($query)
    {
        return $query->where('is_public', true);
    }
}
