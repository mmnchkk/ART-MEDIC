<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\ServiceCategorySectionAll;
use App\Models\ServiceCategorySection;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.main', function ($view) {
            $headerServices = collect();

            try {
                if (Schema::hasTable('service_category_section_alls')) {
                    $headerServices = ServiceCategorySectionAll::with('sections')
                        ->orderBy('id', 'asc')
                        ->get();
                }
            } catch (\Throwable $e) {
                // Если БД недоступна или в процессе миграции
                $headerServices = collect();
            }

            $view->with('headerServices', $headerServices);
        });
    }
}
