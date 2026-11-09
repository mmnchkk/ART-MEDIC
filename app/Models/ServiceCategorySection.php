<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceCategorySection extends Model
{
    protected $fillable = ['section_all_id', 'name', 'description', 'image'];

    public function sectionAll()
    {
        return $this->belongsTo(ServiceCategorySectionAll::class, 'section_all_id');
    }

    public function categories()
    {
        return $this->hasMany(ServiceCategory::class, 'section_id');
    }
}
