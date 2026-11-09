<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Department extends Model
{
    protected $fillable = [
        'clinic_id',
        'name',
        'description',
    ];

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }

    public function directions()
    {
        return $this->hasMany(DepartmentDirection::class);
    }
}
