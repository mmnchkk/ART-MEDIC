<?php

namespace App\Traits;

use App\Models\Specialist;
use App\Models\Unco;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasSlug
{
    /**
     * Boot the HasSlug trait for Eloquent models.
     */
    protected static function bootHasSlug(): void
    {
        static::saving(function (Model $model) {
            if (blank($model->slug)) {
                $source = $model->getSlugSource();
                $model->slug = $model->generateUniqueSlug($source);
            }
        });
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Determine the source text for the slug.
     */
    public function getSlugSource(): string
    {
        if ($this instanceof Specialist) {
            return trim("{$this->lastname} {$this->name} {$this->middle_name}");
        }

        if ($this instanceof Unco) {
            return (string) ($this->title ?? '');
        }

        return (string) ($this->name ?? $this->title ?? '');
    }

    /**
     * Generate a unique slug based on the given or derived source text.
     */
    public function generateUniqueSlug(?string $source = null): string
    {
        $source = $source ?: $this->getSlugSource();
        $baseSlug = Str::slug($source);

        if (blank($baseSlug)) {
            $baseSlug = Str::slug(class_basename($this)) ?: 'item';
        }

        $maxLen = 255;
        $baseSlug = substr($baseSlug, 0, $maxLen);
        $slug = $baseSlug;
        $counter = 2;

        while (static::where('slug', $slug)
            ->when($this->exists, fn ($q) => $q->where($this->getKeyName(), '!=', $this->getKey()))
            ->exists()) {
            $suffix = "-{$counter}";
            $truncatedBase = substr($baseSlug, 0, $maxLen - strlen($suffix));
            $slug = "{$truncatedBase}{$suffix}";
            $counter++;
        }

        return $slug;
    }

    /**
     * Generate sensible default SEO keywords.
     */
    public function generateDefaultKeywords(): string
    {
        $source = $this->getSlugSource();
        return mb_strtolower(trim("{$source}, арт-медика, челябинск, медицинский центр"));
    }

    /**
     * Generate sensible default SEO description.
     */
    public function generateDefaultDescription(): string
    {
        $source = $this->getSlugSource();
        return "{$source} в медицинском центре Арт-Медика в Челябинске. Профессиональные медицинские услуги, передовые технологии и индивидуальный подход.";
    }
}
