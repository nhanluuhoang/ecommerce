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
        'title',
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
                'source' => 'title'
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function children()
    {
        return $this->hasOne(Category::class, 'parent_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parent()
    {
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }
}
