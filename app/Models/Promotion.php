<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'date'
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'promotion_service');
    }
}
