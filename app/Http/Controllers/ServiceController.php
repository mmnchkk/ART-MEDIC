<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategorySectionAll;
use App\Models\ServiceCategorySection;
use App\Models\ServiceCategory;
use App\Models\Service;


class ServiceController extends Controller
{
    public function index()
    {
        $sections = ServiceCategorySectionAll::all();

        return view('servicescategorysectionsall', compact('sections'));
    }

    public function sections($slug = null)
    {
        if ($slug !== null && $slug !== '' && is_numeric($slug)) {
            if (str_contains((string)$slug, '.') || (int)$slug <= 0) {
                abort(404);
            }
            $section = ServiceCategorySection::find((int)$slug);
            if ($section) {
                return redirect()->route('services.section', $section->slug, 301);
            }
            $sectionAll = ServiceCategorySectionAll::find((int)$slug);
            if ($sectionAll) {
                return redirect()->route('services.section', $sectionAll->slug, 301);
            }
            abort(404);
        }

        $sectionAll = null;
        $sections = null;

        if ($slug !== null && $slug !== '') {
            $section = ServiceCategorySection::with('sectionAll')->where('slug', $slug)->first();
            if ($section) {
                $sectionAll = $section->sectionAll;
                $sections = $sectionAll ? $sectionAll->sections : collect([$section]);
                if (!$sections->contains('id', $section->id)) {
                    $sections->push($section);
                }
            } else {
                $sectionAll = ServiceCategorySectionAll::with('sections')->where('slug', $slug)->first();
                if ($sectionAll) {
                    $sections = $sectionAll->sections;
                } else {
                    abort(404);
                }
            }
        } else {
            $sectionAll = ServiceCategorySectionAll::with('sections')->first();
            $sections = $sectionAll ? $sectionAll->sections : ServiceCategorySection::all();
        }

        return view('servicescategorysections', compact('sectionAll', 'sections'));
    }

    public function categories($slug = null)
    {
        if ($slug !== null && $slug !== '' && is_numeric($slug)) {
            if (str_contains((string)$slug, '.') || (int)$slug <= 0) {
                abort(404);
            }
            $category = ServiceCategory::find((int)$slug);
            if ($category) {
                return redirect()->route('services.category', $category->slug, 301);
            }
            $section = ServiceCategorySection::find((int)$slug);
            if ($section) {
                return redirect()->route('services.category', $section->slug, 301);
            }
            abort(404);
        }

        $section = null;
        $categories = null;

        if ($slug !== null && $slug !== '') {
            $category = ServiceCategory::with('section.sectionAll')->where('slug', $slug)->first();
            if ($category) {
                $section = $category->section;
                $categories = $section ? $section->categories : collect([$category]);
                if (!$categories->contains('id', $category->id)) {
                    $categories->push($category);
                }
            } else {
                $section = ServiceCategorySection::with(['sectionAll', 'categories'])->where('slug', $slug)->first();
                if ($section) {
                    $categories = $section->categories;
                } else {
                    abort(404);
                }
            }
        } else {
            $section = ServiceCategorySection::with(['sectionAll', 'categories'])->first();
            $categories = $section ? $section->categories : ServiceCategory::all();
        }

        return view('servicescategories', compact('section', 'categories'));
    }

    public function show($slug = null)
    {
        if ($slug !== null && $slug !== '' && is_numeric($slug)) {
            if (str_contains((string)$slug, '.') || (int)$slug <= 0) {
                abort(404);
            }
            $service = Service::find((int)$slug);
            if ($service) {
                return redirect()->route('services.show', $service->slug, 301);
            }
            $category = ServiceCategory::find((int)$slug);
            if ($category) {
                $catService = Service::where('category_id', $category->id)->first();
                if ($catService) {
                    return redirect()->route('services.show', $catService->slug, 301);
                }
            }
            abort(404);
        }

        $service = null;
        if ($slug !== null && $slug !== '') {
            $service = Service::with([
                'problems',
                'types',
                'results',
                'prices.complexity',
                'specialists.specialities',
                'category.section.sectionAll'
            ])->where('slug', $slug)->first();

            if (!$service) {
                $category = ServiceCategory::where('slug', $slug)->first();
                if ($category) {
                    $service = Service::with([
                        'problems',
                        'types',
                        'results',
                        'prices.complexity',
                        'specialists.specialities',
                        'category.section.sectionAll'
                    ])->where('category_id', $category->id)->first();
                }
            }

            if (!$service) {
                $section = ServiceCategorySection::where('slug', $slug)->first();
                if ($section) {
                    return redirect()->route('services.category', $section->slug, 301);
                }
                $sectionAll = ServiceCategorySectionAll::where('slug', $slug)->first();
                if ($sectionAll) {
                    return redirect()->route('services.section', $sectionAll->slug, 301);
                }
            }

            if (!$service) {
                abort(404);
            }
        } else {
            $service = Service::with([
                'problems',
                'types',
                'results',
                'prices.complexity',
                'specialists.specialities',
                'category.section.sectionAll'
            ])->first();
        }

        return view('services', compact('service'));
    }
}
