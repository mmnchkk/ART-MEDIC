<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $fillable = [
        'level',
        'organisation',
        'year_issue',
        'qualification'
    ];

    public function specialists()
    {
        return $this->belongsTo(Specialist::class);
    }
}
