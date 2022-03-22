<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class OptionValue extends BaseModel
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'value_name'
    ];
}
