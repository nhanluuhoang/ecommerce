<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'variant_value_name',
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
