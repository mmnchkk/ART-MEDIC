<?php

namespace App\Http\Controllers;

use App\Models\Unco;


class UncoController extends Controller
{
    public function index()
    {
        $uncos = Unco::orderBy('data', 'desc')->paginate(4);
        return view('unco', compact('uncos'));
    }

    public function show($slug)
    {
        if (is_numeric($slug)) {
            if (str_contains((string)$slug, '.') || (int)$slug <= 0) {
                abort(404);
            }
            $unco = Unco::findOrFail((int)$slug);
            return redirect()->route('uncos.show', $unco->slug, 301);
        }

        $unco = Unco::where('slug', $slug)->firstOrFail();
        $otherUncos = Unco::where('id', '!=', $unco->id)->orderBy('data', 'desc')->take(4)->get();
        return view('unco_show', compact('unco', 'otherUncos'));
    }
}
