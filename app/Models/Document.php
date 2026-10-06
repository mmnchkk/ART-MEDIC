<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'document_type_id',
        'name',
        'document',
    ];

    public function documentType(){
        return $this->belongsTo(DocumentType::class);
    }

}
