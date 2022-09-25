<?php

namespace App\Models;

class OptionValue extends BaseModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'value'
    ];

    protected $hidden = ['laravel_through_key'];
}
