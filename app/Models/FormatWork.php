<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormatWork extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
