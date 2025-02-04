<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['comments.person', 'person'])->get();

        return response()->json([
            'success' => true,
            'posts' => $posts,
        ]);
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

    public function getPosts()
    {
    $posts = Post::with(['comments', 'likes'])->get();
    return response()->json(['success' => true, 'posts' => $posts]);
    }

    public function likePost(Request $request)
{
    
    $request->validate([
        'PostId' => 'required|exists:_post,id',
    ]);

    $user = auth()->user();
    if (!$user) {
        return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
    }

    
    $existingLike = Like::where('UserId', $user->id)
                        ->where('PostId', $request->PostId)
                        ->first();

    if ($existingLike) {
        return response()->json([
            'success' => false,
            'message' => 'You have already liked this post!',
        ], 400);
    }

    // Add a new like record
    Like::create([
        'UserId' => $user->id,
        'PostId' => $request->PostId,
    ]);

    
    $post = Post::findOrFail($request->PostId);
    $post->increment('LikesCount');

    return response()->json([
        'success' => true,
        'message' => 'Post liked successfully!',
        'LikesCount' => $post->LikesCount,
    ]);
}

    
    public function addComment(Request $request)
    {
        // Manually authenticate user
        $user = auth()->user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }
    
        // Validate the request
        $request->validate([
            'PostId' => 'required|exists:_post,id',
            'Content' => 'required|string|min:1|max:500',
        ]);
    
        try {
            // Find the post
            $post = Post::findOrFail($request->PostId);
    
            // Create the comment
            $comment = $post->comments()->create([
                'UserId' => $user->id, // Use authenticated user ID
                'Content' => $request->Content,
            ]);
    
            return response()->json([
                'success' => true,
                'message' => 'Comment added successfully',
                'comment' => $comment->load('person'),
            ]);
        } catch (\Exception $e) {
            \Log::error('Error adding comment: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to add comment'], 500);
        }
    }

    public function searchPosts(Request $request)
    {
        $query = $request->input('query');
        $category = $request->input('category');

        $posts = Post::query();

        // Search by title
        if (!empty($query)) {
            $posts->where('Title', 'LIKE', "%{$query}%");
        }

        // Filter by category
        if (!empty($category)) {
            $posts->where('Category', $category);
        }

        return response()->json([
            'success' => true,
            'posts' => $posts->with('comments.person')->get()
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
    
        
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }
    
        
        $user = $request->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    
        
        if ($post->AuthorId !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
    
       
        $validated = $request->validate([
            'Title' => 'sometimes|string|max:255',
            'Content' => 'sometimes|string',
        ]);
    
        
        $post->update($validated);
    
        return response()->json(['success' => true, 'message' => 'Post updated successfully', 'post' => $post]);
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
