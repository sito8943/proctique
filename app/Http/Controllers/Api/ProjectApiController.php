<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectIndexResource;
use App\Http\Resources\ProjectShowResource;
use App\Models\Project;

class ProjectApiController extends Controller
{
    public function index()
    {
        $perPage = request()->get('per_page', 5);

        $projects = Project::query()
            ->select(['id', 'name', 'author_id', 'leading'])
            ->with('author:id,name')
            ->whereNotNull('published_at')
            ->paginate($perPage);

        return ProjectIndexResource::collection($projects);
    }

    public function show(int $id)
    {
        $project = Project::query()
            ->select(['id', 'name', 'author_id', 'leading', 'content'])
            //TODO CHECK THIS WITH NICO
            ->with('author:id,name', 'tags:id,name,color', 'reviews')
            ->find($id);

        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        return new ProjectShowResource($project);
    }
}

