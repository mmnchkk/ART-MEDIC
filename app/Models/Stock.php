<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'name',
        'description',
        'date',
        'image'
    ];
    public function service()
    {
        return $this->belongsToMany(Service::class, 'stock_service');
    }
}
