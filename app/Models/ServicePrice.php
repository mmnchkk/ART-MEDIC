<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicePrice extends Model
{
    protected $fillable = [
        'service_id',
        'complexity_id',
        'code',
        'code_mis',
        'name',
        'duration',
        'price',
        'price_category_1',
        'price_category_2',
        'price_category_3',
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
