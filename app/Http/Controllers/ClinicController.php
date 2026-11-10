<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use Illuminate\Http\Request;

class ClinicController extends Controller
{
    public function index()
    {
        $clinic = Clinic::with('departments.directions')
            ->first();

        return view('clinic', compact('clinic'));
    }
}
