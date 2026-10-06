<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $fillable = [
        'phone',
        'description',
    ];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}