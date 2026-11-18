<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;

class ServiceCategorySectionAll extends Model
{
    use HasSlug;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'keywords',
        'image',
    ];

    public function sections()
    {
        return $this->hasMany(ServiceCategorySection::class, 'section_all_id');
    }
}
