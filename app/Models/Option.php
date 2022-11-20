<?php

namespace App\Models;

class Option extends BaseModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'value'
    ];

    protected $hidden = ['laravel_through_key', 'pivot'];

    public function optionValues()
    {
        return $this->hasManyThrough(
            OptionValue::class,
            VariantValue::class,
            'option_id',
            'id',
            'id',
            'value_id'
        );
    }
}
