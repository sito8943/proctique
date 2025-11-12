<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;

class ProjectController extends Controller
{
    function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    function show(int $projectId)
    {
        $project = Project::find($projectId);
        return view('projects.show', compact(['project']));
    }
}
