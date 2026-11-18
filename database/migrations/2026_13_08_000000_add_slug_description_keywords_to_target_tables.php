<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Target tables for slug, description, and keywords.
     *
     * @var array<string>
     */
    protected array $tables = [
        'services',
        'service_categories',
        'service_category_sections',
        'service_category_section_alls',
        'specialists',
        'promotions',
        'projects',
        'uncos',
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Add columns to all target tables
        foreach ($this->tables as $table) {
            if (Schema::hasTable($table)) {
                Schema::table($table, function (Blueprint $blueprint) use ($table) {
                    if (!Schema::hasColumn($table, 'slug')) {
                        $blueprint->string('slug')->nullable()->unique();
                    }
                    if (!Schema::hasColumn($table, 'description')) {
                        $blueprint->text('description')->nullable();
                    }
                    if (!Schema::hasColumn($table, 'keywords')) {
                        $blueprint->text('keywords')->nullable();
                    }
                });
            }
        }

        // 2. Backfill existing records with unique slugs, sensible default descriptions and keywords
        foreach ($this->tables as $table) {
            if (!Schema::hasTable($table)) {
                continue;
            }

            $rows = DB::table($table)->orderBy('id')->get();
            $usedSlugs = [];

            foreach ($rows as $row) {
                $rawTitle = '';
                if ($table === 'specialists') {
                    $rawTitle = trim("{$row->lastname} {$row->name} {$row->middle_name}");
                } elseif ($table === 'uncos') {
                    $rawTitle = (string) ($row->title ?? '');
                } else {
                    $rawTitle = (string) ($row->name ?? '');
                }

                $baseSlug = Str::slug($rawTitle);
                if (blank($baseSlug)) {
                    $baseSlug = 'item';
                }

                $maxLen = 255;
                $baseSlug = substr($baseSlug, 0, $maxLen);

                $slug = $baseSlug;
                $counter = 2;
                while (isset($usedSlugs[$slug])) {
                    $suffix = "-{$counter}";
                    $truncatedBase = substr($baseSlug, 0, $maxLen - strlen($suffix));
                    $slug = "{$truncatedBase}{$suffix}";
                    $counter++;
                }
                $usedSlugs[$slug] = true;

                $updates = ['slug' => $slug];

                if (empty($row->description)) {
                    $updates['description'] = "{$rawTitle} в медицинском центре Арт-Медика в Челябинске. Профессиональные медицинские услуги, передовые технологии и индивидуальный подход.";
                }

                if (empty($row->keywords)) {
                    $updates['keywords'] = mb_strtolower("{$rawTitle}, арт-медика, челябинск, медицинский центр");
                }

                DB::table($table)->where('id', $row->id)->update($updates);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        foreach ($this->tables as $table) {
            if (!Schema::hasTable($table)) {
                continue;
            }

            Schema::table($table, function (Blueprint $blueprint) use ($table) {
                $columnsToDrop = [];

                if (Schema::hasColumn($table, 'slug')) {
                    $columnsToDrop[] = 'slug';
                }

                // Only drop description on service_categories because the other 7 tables had it originally
                if ($table === 'service_categories' && Schema::hasColumn($table, 'description')) {
                    $columnsToDrop[] = 'description';
                }

                if (Schema::hasColumn($table, 'keywords')) {
                    $columnsToDrop[] = 'keywords';
                }

                if (!empty($columnsToDrop)) {
                    $blueprint->dropColumn($columnsToDrop);
                }
            });
        }
    }
};
