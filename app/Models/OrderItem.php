<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends BaseModel
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id',
        'order_id',
        'product_title',
        'product_variant_name',
        'quantity',
        'price',
        'discount_amount'
    ];

    protected $casts = [
        'price' => 'double'
    ];
}
