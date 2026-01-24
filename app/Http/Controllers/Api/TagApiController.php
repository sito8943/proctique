<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagIndexResource;
use App\Models\Tag;

class TagApiController extends Controller
{
    public function index()
    {
        $tags = Tag::query()
            ->select('id', 'name', 'color')
            ->orderBy('name')
            ->get();

        return TagIndexResource::collection($tags);
    }
}

