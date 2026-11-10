<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specialist;
use App\Models\Speciality;

class SpecialistController extends Controller
{
    public function index(Request $request)
    {
        $selectedSpeciality = $request->query('speciality');

        $specialistsQuery = Specialist::with(['specialities', 'educations', 'accreditations', 'directions']);

        if ($selectedSpeciality) {
            $specialistsQuery->whereHas('specialities', function ($q) use ($selectedSpeciality) {
                $q->where('name', $selectedSpeciality)
                  ->orWhere('specialities.id', $selectedSpeciality);
            });
        }

        $specialists = $specialistsQuery->get();
        $specialities = Speciality::all();

        return view('specialists', compact('specialists', 'specialities', 'selectedSpeciality'));
    }

    public function show($id)
    {
        $specialist = Specialist::with(['specialities', 'educations', 'accreditations', 'directions'])->findOrFail($id);
        return view('specialist_show', compact('specialist'));
    }
}
