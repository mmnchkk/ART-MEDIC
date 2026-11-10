<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategorySectionAll;
use App\Models\ServiceCategorySection;
use App\Models\Service;
use App\Models\Specialist;

class ServiceController extends Controller
{
    public function index()
    {
        $sections = ServiceCategorySectionAll::all();

        return view('servicescategorysectionsall', compact('sections'));
    }

    public function sections($id = null)
    {
        $sectionAll = null;
        if ($id) {
            $sectionAll = ServiceCategorySectionAll::with('sections')->find($id);
        }

        if (!$sectionAll) {
            $sectionAll = ServiceCategorySectionAll::with('sections')->first();
        }

        $sections = $sectionAll ? $sectionAll->sections : ServiceCategorySection::all();

        return view('servicescategorysections', compact('sectionAll', 'sections'));
    }

    public function categories($id = null)
    {
        $section = null;
        if ($id) {
            $section = ServiceCategorySection::with(['sectionAll', 'categories'])->find($id);
        }

        if (!$section) {
            $section = ServiceCategorySection::with(['sectionAll', 'categories'])->first();
        }

        $categories = $section ? $section->categories : ServiceCategory::all();

        return view('servicescategories', compact('section', 'categories'));
    }

    public function show($id = null)
    {
        $service = null;
        if ($id) {
            $service = Service::with([
                'problems',
                'types',
                'results',
                'prices.complexity',
                'specialists.specialities',
                'category.section.sectionAll'
            ])->find($id);

            if (!$service) {
                $service = Service::with([
                    'problems',
                    'types',
                    'results',
                    'prices.complexity',
                    'specialists.specialities',
                    'category.section.sectionAll'
                ])->where('category_id', $id)->first();
            }
        }

        if (!$service) {
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
