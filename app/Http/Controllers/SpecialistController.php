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

    public function show($slug)
    {
        if (is_numeric($slug)) {
            if (str_contains((string)$slug, '.') || (int)$slug <= 0) {
                abort(404);
            }
            $specialist = Specialist::findOrFail((int)$slug);
            return redirect()->route('specialists.show', $specialist->slug, 301);
        }

        $specialist = Specialist::with(['specialities', 'educations', 'accreditations', 'directions'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('specialist_show', compact('specialist'));
    }
}
