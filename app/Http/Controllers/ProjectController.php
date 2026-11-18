<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('images')->orderBy('date', 'desc')->paginate(6);
        return view('projects', compact('projects'));
    }

    public function show($slug)
    {
        if (is_numeric($slug)) {
            if (str_contains((string)$slug, '.') || (int)$slug <= 0) {
                abort(404);
            }
            $project = Project::findOrFail((int)$slug);
            return redirect()->route('projects.show', $project->slug, 301);
        }

        $project = Project::with(['images', 'formatWorks', 'projectStages', 'partners'])
            ->where('slug', $slug)
            ->firstOrFail();

        $otherProjects = Project::with('images')
            ->where('id', '!=', $project->id)
            ->orderBy('date', 'desc')
            ->take(3)
            ->get();

        return view('project', compact('project', 'otherProjects'));
    }
}
