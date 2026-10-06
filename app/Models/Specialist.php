<?php

namespace App\Models;

use Directory;
use Illuminate\Database\Eloquent\Model;

class Specialist extends Model
{
    protected $fillable = [
        'lastname',
        'name',
        'middle_name',
        'description',
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
        return $this->hasMany(Speciality::class);
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
