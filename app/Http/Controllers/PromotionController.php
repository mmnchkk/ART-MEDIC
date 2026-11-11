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

    public function show(Request $request, $id)
    {
        $promotion = Promotion::with(['services.prices', 'services.specialists'])
            ->findOrFail($id);

        $otherPromotions = Promotion::with('services')
            ->where('id', '!=', $id)
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(2);

        return view('promotion_show', compact('promotion', 'otherPromotions'));
    }
}
