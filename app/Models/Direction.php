<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    protected $fillable = [
        'name'
    ];

    public function specialists()
    {
        return $this->belongsTo(Specialist::class, 'specialist_direction');
    }
}
