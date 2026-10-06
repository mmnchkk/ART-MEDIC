<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    protected $fillable = [
        'mail',
        'description',
    ];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}