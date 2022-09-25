<?php

namespace App\Models;


class Attachments extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'attachable_id',
        'attachable_type',
        'name',
        'mime',
        'size',
        'disk',
        'path',
    ];

    protected $hidden = [
        'attachable_id',
        'attachable_type'
    ];

    /**
     * @param $value
     * @return string
     */
    public function getPathAttribute($value): string
    {
        return config('ecommerce.app_url').'/assets/'.$value;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function attachable()
    {
        return $this->morphTo();
    }
}
