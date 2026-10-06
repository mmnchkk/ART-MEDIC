<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unco extends Model
{
    protected $fillable = [
        'title',
        'data',
        'image',
        'description',
    ];
}
