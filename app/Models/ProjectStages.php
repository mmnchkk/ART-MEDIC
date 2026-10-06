<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectStages extends Model
{
    protected $fillable = [
        'name'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
