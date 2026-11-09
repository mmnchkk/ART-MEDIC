<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategorySectionAll;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        // Получаем все разделы верхнего уровня вместе с вложенными подразделами, категориями и услугами
        $sections = ServiceCategorySectionAll::with('sections.categories.services')->get();

        return view('services.index', compact('sections'));
    }

    public function show($id)
    {
        // Получаем конкретную услугу со всеми связанными данными (проблемы, цены, врачи и т.д.)
        $service = Service::with(['problems', 'types', 'results', 'prices.complexity', 'specialists'])->findOrFail($id);

        return view('services.show', compact('service'));
    }
}
