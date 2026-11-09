<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['category_id', 'name', 'description', 'preparation', 'method'];

    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }

    public function problems()
    {
        return $this->hasMany(ServiceProblem::class);
    }

    public function types()
    {
        return $this->hasMany(ServiceType::class);
    }

    public function results()
    {
        return $this->hasMany(ServiceResult::class);
    }

    public function prices()
    {
        return $this->hasMany(ServicePrice::class);
    }

    public function specialists()
    {
        return $this->belongsToMany(Specialist::class, 'specialist_service');
    }
}
