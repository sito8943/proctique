<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('tags.index', compact('tags'));
    }

    public function show(int $tagId)
    {
        $tag = Tag::find($tagId);
        return view('tags.show', compact(['tag']));
    }

    public function create()
    {
        return view('tags.create');
    }

    public function edit($id)
    {
        $tag = Tag::find($id);
        return view('tags.edit', compact(['tag']));
    }

    public function store(Request $request)
    {
        Tag::create([
            'name' => $request->name,
            'color' => $request->color,
        ]);
        return $this->index();
    }

    public function update(Request $request, $id)
    {

        $tag = Tag::find($id);

        $tag->update([
            'name' => $request->name,
            'color' => $request->color,
        ]);

        return $this->index();
    }

    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag->delete();
        return $this->index();
    }
}
