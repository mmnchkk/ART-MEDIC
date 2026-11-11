<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategorySectionAll;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function index()
    {
        // Загружаем дерево: Направление (sectionAll) -> Разделы (sections) -> Категории (categories) -> Услуги (services) -> Цены (prices)
        $sectionAlls = ServiceCategorySectionAll::with([
            'sections.categories.services.prices'
        ])->get();

        // Формируем структурированные данные для прайс-листа
        $priceSections = [];

        foreach ($sectionAlls as $sectionAll) {
            $accordionItems = [];

            // Пробегаем по sections данного направления
            foreach ($sectionAll->sections as $section) {
                // Собираем все цены услуг в этой секции
                $sectionPrices = collect();

                foreach ($section->categories as $category) {
                    foreach ($category->services as $service) {
                        if ($service->prices && $service->prices->isNotEmpty()) {
                            foreach ($service->prices as $price) {
                                $sectionPrices->push([
                                    'service_name' => $service->name,
                                    'code' => $price->code,
                                    'code_mis' => $price->code_mis,
                                    'name' => $price->name,
                                    'duration' => $price->duration,
                                    'price' => $price->price ? (float)$price->price : null,
                                    'price_category_1' => $price->price_category_1 ? (float)$price->price_category_1 : null,
                                    'price_category_2' => $price->price_category_2 ? (float)$price->price_category_2 : null,
                                    'price_category_3' => $price->price_category_3 ? (float)$price->price_category_3 : null,
                                ]);
                            }
                        }
                    }
                }

                // Выводим только там, где есть цены
                if ($sectionPrices->isNotEmpty()) {
                    // Рассчитываем минимальную цену для "от X ₽"
                    $minPrice = null;
                    foreach ($sectionPrices as $p) {
                        $candidates = array_filter([
                            $p['price'],
                            $p['price_category_1'],
                            $p['price_category_2'],
                            $p['price_category_3']
                        ], fn($val) => $val !== null && $val > 0);

                        if (!empty($candidates)) {
                            $itemMin = min($candidates);
                            if ($minPrice === null || $itemMin < $minPrice) {
                                $minPrice = $itemMin;
                            }
                        }
                    }

                    // Разделяем цены на:
                    // 1) Обычные (единая цена)
                    // 2) Категорийные (где есть cat1, cat2 или cat3)
                    $simplePrices = $sectionPrices->filter(function ($item) {
                        return empty($item['price_category_1']) && empty($item['price_category_2']) && empty($item['price_category_3']);
                    })->values();

                    $categoryPrices = $sectionPrices->filter(function ($item) {
                        return !empty($item['price_category_1']) || !empty($item['price_category_2']) || !empty($item['price_category_3']);
                    })->values();

                    $accordionItems[] = [
                        'id' => $section->id,
                        'name' => $section->name,
                        'min_price' => $minPrice,
                        'simple_prices' => $simplePrices,
                        'category_prices' => $categoryPrices,
                        'all_prices' => $sectionPrices,
                    ];
                }
            }

            if (!empty($accordionItems)) {
                $priceSections[] = [
                    'id' => $sectionAll->id,
                    'name' => $sectionAll->name,
                    'items' => $accordionItems,
                ];
            }
        }

        return view('prices', compact('priceSections'));
    }
}

