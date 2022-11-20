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

    protected $appends = [
        'category_title'
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
     * @return mixed
     */
    public function getCategoryTitleAttribute()
    {
        return $this->category()->pluck('title')->first();
    }

    /**
     * @param $value
     * @return string
     */
    public function getThumbnailsAttribute($value)
    {
        return config('ecommerce.app_url').'/assets/'.$value;
    }

    public function getPriceAttribute($value)
    {
        $price = number_format($value, 0, '', '.');
        $prices = $this->variantValues()->get()->pluck('price')->toArray();
        if (count($prices) > 0) {
            $min = min($prices);
            $max = max($prices);
            if ($min == $max) return $price;

            $price = number_format($min, 0, '', '.') .' - '.
                number_format($max, 0, '', '.');
        }

        return $price;
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
            'product_id'
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function images()
    {
        return $this->morphMany(Attachments::class, 'attachable', 'attachable_type', 'attachable_id');
    }
}
