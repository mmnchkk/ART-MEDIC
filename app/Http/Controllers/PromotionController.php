<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::with('services')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('promotions.index', compact('promotions'));
    }

    public function show($id)
    {
        $promotion = Promotion::with(['services.prices', 'services.specialists'])
            ->findOrFail($id);

        return view('promotions.show', compact('promotion'));
    }
}

