<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parten extends Model
{
    protected $table = 'partens';

    protected $fillable = [
        'project_id',
        'name',
        'description',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
