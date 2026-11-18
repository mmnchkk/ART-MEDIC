<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasSlug;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'keywords',
        'image',
        'date'
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'promotion_service');
    }
}
