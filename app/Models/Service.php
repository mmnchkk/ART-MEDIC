<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'description',
        'preparation',
        'method'
    ];

    public function stocks()
    {
        return $this->belongsToMany(Stock::class, 'stock_service');
    }
    public function prices()
    {
        return $this->hasMany(ServicePrice::class);
    }

    public function types()
    {
        return $this->hasMany(ServiceType::class);
    }

    public function results()
    {
        return $this->hasMany(ServiceResult::class);
    }

    public function problems()
    {
        return $this->hasMany(ServiceProblem::class);
    }

    public function categories()
    {
        return $this->hasMany(ServiceCategory::class);
    }

    public function specialists()
    {
        return $this->belongsToMany(Specialist::class, 'specialist_service');
    }
}
