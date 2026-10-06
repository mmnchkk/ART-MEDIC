<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'short_desc',
        'description',
        'date',
        'count_season',
        'count_members',
        'count_expert',
        'count_parterns'
    ];

    public function projectStages()
    {
        return $this->hasMany(ProjectStages::class);
    }

    public function formatWorks()
    {
        return $this->hasMany(FormatWork::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function partners()
    {
        return $this->hasMany(Parten::class);
    }
}
