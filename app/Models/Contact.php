<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'adress',
        'sms',
        'schedule',
    ];

    public function mails()
    {
        return $this->hasMany(Mail::class);
    }

    public function phones()
    {
        return $this->hasMany(Phone::class);
    }
}