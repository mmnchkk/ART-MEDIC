<?php

namespace App\Models;

use App\Traits\HasSlug;
use Directory;
use Illuminate\Database\Eloquent\Model;

class Specialist extends Model
{
    use HasSlug;

    protected $fillable = [
        'lastname',
        'name',
        'middle_name',
        'slug',
        'description',
        'keywords',
        'experience',
        'count_operations',
        'percentage_reviews',
        'image'
    ];

    public function getFullNameAttribute(): string
    {
        return trim("{$this->lastname} {$this->name} {$this->middle_name}");
    }

    public function specialities(){
        return $this->belongsToMany(Speciality::class, 'specialist_speciality');
    }

    public function directions(){
        return $this->hasMany(Direction::class);
    }

    public function educations(){
        return $this->hasMany(Education::class);
    }

    public function accreditations(){
        return $this->hasMany(Accreditation::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'specialist_service');
    }
}
