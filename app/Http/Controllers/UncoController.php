<?php

namespace App\Http\Controllers;

use App\Models\Unco;


class UncoController extends Controller
{
    public function index(){
        $uncos = Unco::all();
        return view('unco', compact('uncos'));
    }
}
