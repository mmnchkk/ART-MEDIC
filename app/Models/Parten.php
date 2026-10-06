<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parten extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
