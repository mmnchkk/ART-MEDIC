<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;

class Unco extends Model
{
    use HasSlug;

    protected $fillable = [
        'title',
        'slug',
        'data',
        'image',
        'description',
        'keywords',
    ];
}
