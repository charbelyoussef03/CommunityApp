<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['person'])->get();
        return response()->json($posts);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Title' => 'required|string|max:255',
            'Category' => 'required|string',
            'AuthorId' => 'required|exists:_person,id',
            'ViewsCount' => 'nullable|integer',
            'LikesCount' => 'nullable|integer',
            'IsFlagged' => 'required|boolean',
            'IsApproved' => 'required|boolean',
            'Content' => 'required|string',
            'PictureUrl' => 'required|string'
        ]);

        $post = Post::create(array_merge($validated, [
            'ViewsCount' => $request->input('ViewsCount', 0),
            'LikesCount' => 0,
            'IsFlagged' => false,
            'IsApproved' => false,
        ]));

        return response()->json($post, 201);
    }

    public function show(string $id)
    {
        try {
            $post = Post::with(['comment', 'vote'])->findOrFail($id);
            return response()->json($post);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Post not found.'], 404);
        }
    }

    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);

        $validated = $request->validate([
            'Title' => 'sometimes|string|max:255',
            'Content' => 'sometimes|string',
            'Category' => 'required|string',
            'PictureUrl' => 'required|string',
            'IsApproved' => 'required|boolean',
            'IsFlagged' => 'required|boolean',
        ]);
       
        $post->update($validated);
        return response()->json($post);
    }

    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return response()->json(['message' => 'Post deleted successfully.']);
    }
}
