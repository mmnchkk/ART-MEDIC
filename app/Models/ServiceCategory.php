<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    protected $fillable = ['parent_id', 'section_id', 'name'];

    public function parent()
    {
        return $this->belongsTo(ServiceCategory::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(ServiceCategory::class, 'parent_id');
    }

    public function section()
    {
        return $this->belongsTo(ServiceCategorySection::class, 'section_id');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'category_id');
    }
}
