<?php

namespace App\Http\Controllers;

use App\Models\Project;

class WelcomeController extends Controller
{
    function __invoke()
    {

        $recentProjects = Project::query()
            ->select('id', 'author_id', 'leading', 'published_at', 'name')
            ->with('author:id,name', 'tags', 'media')
            ->where('is_published', true)
            ->latest('published_at')
            ->take(4)
            ->get();

        $mostRecentProject = $recentProjects->shift();

        return view('welcome', compact('mostRecentProject', 'recentProjects'));
    }
}
