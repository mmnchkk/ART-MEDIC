<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    protected $fillable = [
        'name'
    ];

    public function specialist()
    {
        return $this->belongsTo(Specialist::class);
    }
}
