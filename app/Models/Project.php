<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasSlug;

    protected $fillable = [
        'name',
        'slug',
        'short_desc',
        'description',
        'keywords',
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
