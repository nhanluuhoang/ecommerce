<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;

class Product extends BaseModel
{
    use Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_id',
        'user_id',
        'title',
        'slug',
        'descriptions',
        'thumbnails',
        'price',
        'status',
        'sku',
        'stock',
        'details',
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
}
