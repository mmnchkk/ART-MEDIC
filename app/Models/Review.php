<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'rating',
        'desc_story',
        'desc_like',
        'date',
    ];
}
