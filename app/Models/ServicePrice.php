<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicePrice extends Model
{
    protected $fillable = [
        'price',
        'complexity_id',
        'service_id',
        'code',
        'code_mis',
        'name',
        'duration',
        'price'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function complexity()
    {
        return $this->belongsTo(ServiceComplexity::class, 'complexity_id');
    }
}
