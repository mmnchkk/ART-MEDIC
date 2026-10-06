<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    protected $fillable = [
        'service_id',
        'description',
        'image'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
