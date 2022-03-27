<?php

namespace App\Models;

class VariantValue extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id',
        'option_id',
        'value_id',
        'product_value_name',
        'sku',
        'quantity',
        'price'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'price' => 'double'
    ];
}
