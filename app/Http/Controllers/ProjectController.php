<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    function index()
    {
        return view('projects.index');
    }

    function show($project)
    {
        return view('projects.show', compact('project'));
    }
}
