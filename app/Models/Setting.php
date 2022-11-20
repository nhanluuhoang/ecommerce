<?php

namespace App\Models;

class Setting extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_logo',
        'company_name',
        'company_info',
        'company_address',
        'company_tax_code',
        'company_contact',
        'return_policy',
        'terms_of_sale',
        'delivery_policy',
        'payment_methods',
        'information_privacy_policy',
        'shop_online',
        'social_network'
    ];

    protected $casts = [
        'company_contact' => 'array',
        'shop_online'     => 'array',
        'social_network'  => 'array',
    ];
}
