<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    protected $fillable = [
        'image'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
