<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accreditation extends Model
{
    protected $fillable = [
        'specialist_id',
        'type_doc',
        'speciality',
        'position',
        'date_issue',
        'validity_period',
        'note'
    ];

    public function specialist()
    {
        return $this->belongsTo(Specialist::class);
    }
}
