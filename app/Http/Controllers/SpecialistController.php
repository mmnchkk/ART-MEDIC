<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specialist;

class SpecialistController extends Controller
{
    public function index()
    {
        $specialists = Specialist::with(['specialities', 'educations', 'accreditations', 'directions'])->get();
        return view('specialists', compact('specialists'));
    }

    public function show($id)
    {
        $specialist = Specialist::with(['specialities', 'educations', 'accreditations', 'directions'])->findOrFail($id);
        return view('specialist_show', compact('specialist'));
    }
}
