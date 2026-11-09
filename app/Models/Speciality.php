<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    protected $fillable = [
        'name'
    ];

    public function specialists()
    {
        return $this->belongsToMany(Specialist::class, 'specialist_speciality');
    }
}
