<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasSlug;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'keywords',
        'preparation',
        'method',
    ];

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

    public function promotions()
    {
    return $this->belongsToMany(Promotion::class, 'promotion_service');
    }

}
