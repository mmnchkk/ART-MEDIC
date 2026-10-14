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

    public function show($id)
    {
        $unco = Unco::findOrFail($id);
        $otherUncos = Unco::where('id', '!=', $id)->orderBy('data', 'desc')->take(4)->get();
        return view('unco_show', compact('unco', 'otherUncos'));
    }
}
