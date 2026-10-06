<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceComplexity extends Model
{
    protected $fillable = [
        'first_complexities',
        'second_complexities',
        'third_complexities'
    ];

    public function servicePrices()
    {
        return $this->hasMany(ServicePrice::class, 'complexity_id');
    }
}
