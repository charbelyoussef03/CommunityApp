<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $posts = _post::with(['person', 'category'])->get();
        return response()->json($posts);
    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'person_id' => 'required|exists:people,id',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $post = _post::create($validated);
        return response()->json($post, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $post = _post::with(['comments', 'votes'])->findOrFail($id);
        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $post = _post::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'body' => 'sometimes|string',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $post->update($validated);
        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $post = _post::findOrFail($id);
        $post->delete();
        return response()->json(['message' => 'Post deleted successfully.']);
    }
}
