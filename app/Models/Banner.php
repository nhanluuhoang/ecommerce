<?php

namespace App\Models;

class Banner extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['src', 'link', 'is_public'];

    protected $casts = [
        'is_public' => 'boolean'
    ];

    /**
     * @param $value
     * @return string
     */
    public function getSrcAttribute($value): string
    {
        return config('ecommerce.app_url').'/assets/'.$value;
    }
}
