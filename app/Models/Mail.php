<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    protected $fillable = [
        'contact_id',
        'mail',
        'description',
    ];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}