<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::with('services')
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(4);

        return view('promotions', compact('promotions'));
    }

    public function show(Request $request, $slug)
    {
        if (is_numeric($slug)) {
            if (str_contains((string)$slug, '.') || (int)$slug <= 0) {
                abort(404);
            }
            $promotion = Promotion::findOrFail((int)$slug);
            return redirect()->route('promotions.show', $promotion->slug, 301);
        }

        $promotion = Promotion::with(['services.prices', 'services.specialists'])
            ->where('slug', $slug)
            ->firstOrFail();

        $otherPromotions = Promotion::with('services')
            ->where('id', '!=', $promotion->id)
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(2);

        return view('promotion_show', compact('promotion', 'otherPromotions'));
    }
}
