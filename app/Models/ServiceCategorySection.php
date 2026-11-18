<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;

class ServiceCategorySection extends Model
{
    use HasSlug;

    protected $fillable = [
        'section_all_id',
        'name',
        'slug',
        'description',
        'keywords',
        'image',
    ];

    public function sectionAll()
    {
        return $this->belongsTo(ServiceCategorySectionAll::class, 'section_all_id');
    }

    public function categories()
    {
        return $this->hasMany(ServiceCategory::class, 'section_id');
    }
}
