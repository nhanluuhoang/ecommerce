<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class ShipmentItem extends BaseModel
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'shipment_id',
        'order_item_id',
        'quantity'
    ];
}
