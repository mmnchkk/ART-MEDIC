<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Clinic extends Model
{
    protected $fillable = [
        'description',
        'image',
        'count_study',
        'count_projects',
        'count_reviews',
    ];

    // У клиники много отделений
    public function departments(): HasMany
    {
        return $this->hasMany(Department::class);
    }
}
