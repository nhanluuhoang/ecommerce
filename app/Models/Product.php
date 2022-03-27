<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends BaseModel
{
    use Sluggable, SoftDeletes;

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
        'quantity'
    ];

    protected $casts = [
        'price'  => 'double',
        'status' => 'boolean'
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function variantValues()
    {
        return $this->hasMany(VariantValue::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function options()
    {
        return $this->hasManyThrough(
            Option::class,
            VariantValue::class,
            'product_id',
            'id',
            'id',
            'option_id'
        )->distinct();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function optionValues()
    {
        return $this->hasManyThrough(
            OptionValue::class,
            VariantValue::class,
            'product_id',
            'id',
            'id',
            'value_id'

        );
    }
}
