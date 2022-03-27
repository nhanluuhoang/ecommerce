<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Shipment extends BaseModel
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'invoice_id',
        'full_name',
        'phone',
        'address',
        'order_code',
        'shipment_date',
        'shipment_status'
    ];

    protected $casts = [
      'address' => 'array'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shipmentItems() {
        return $this->hasMany(ShipmentItem::class);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getAddressAttribute($value)
    {
        return json_decode($value)->address;
    }
}
