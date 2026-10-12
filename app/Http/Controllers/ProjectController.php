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

    public function show($id)
    {
        $project = Project::with(['images', 'formatWorks', 'projectStages', 'partners'])->findOrFail($id);
        $otherProjects = Project::with('images')->where('id', '!=', $id)->orderBy('date', 'desc')->take(3)->get();
        return view('project', compact('project', 'otherProjects'));
    }
}
