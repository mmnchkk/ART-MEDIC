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
            ->paginate(6);

        return view('promotions', compact('promotions'));
    }

    public function show($id)
    {
        $promotion = Promotion::with(['services.prices', 'services.specialists'])
            ->findOrFail($id);

        return view('promotion_show', compact('promotion'));
    }
}
