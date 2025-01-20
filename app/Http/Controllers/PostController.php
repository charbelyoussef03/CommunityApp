<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['person'])->get();
        return response()->json($posts);
    }

    public function store(Request $request)
{
    // Get the authenticated user
    $user = Auth::user();

    // Ensure that the user is authenticated
    if (!$user) {
        return response()->json(['error' => 'User not authenticated'], 401);
    }

    // Validate the incoming request
    try {
        $validated = $request->validate([
            'Title' => 'required|string|max:255',
            'Category' => 'required|string',
            'Content' => 'required|string',
            'PictureUrl' => 'required|string',
        ]);
    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json(['errors' => $e->errors()], 422);
    }

    // Create the post
    try {
        $post = Post::create([
            'Title' => $validated['Title'],
            'Category' => $validated['Category'],
            'Content' => $validated['Content'],
            'PictureUrl' => $validated['PictureUrl'],
            'AuthorId' => $user->id, // Use the authenticated user's ID
            'ViewsCount' => 0, // Default value for ViewsCount
            'LikesCount' => 0, // Default value for LikesCount
            'IsFlagged' => false, // Default value for IsFlagged
            'IsApproved' => false, // Default value for IsApproved
        ]);

        return response()->json([
            'message' => 'Post created successfully!',
            'post' => $post
        ], 201);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Server error.'], 500);
    }
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
    public function getUserPosts()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $posts = $user->posts;
        return response()->json(['posts' => $posts], 200);
    }
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return response()->json(['message' => 'Post deleted successfully.']);
    }
}
