<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceCategorySectionAll extends Model
{
    protected $fillable = ['name', 'description', 'image'];

    public function sections()
    {
        return $this->hasMany(ServiceCategorySection::class, 'section_all_id');
    }
}
