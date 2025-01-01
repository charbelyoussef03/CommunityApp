<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function store(Request $request)
    {
        $validated = $request->validate([
            'body' => 'required|string',
            'post_id' => 'required|exists:posts,id',
            'person_id' => 'required|exists:people,id',
        ]);

        $comment = _comment::create($validated);
        return response()->json($comment, 201);
    }

    public function update(Request $request, $id)
    {
        $comment = _comment::findOrFail($id);

        $validated = $request->validate([
            'body' => 'required|string',
        ]);

        $comment->update($validated);
        return response()->json($comment);
    }

    public function destroy($id)
    {
        $comment = _comment::findOrFail($id);
        $comment->delete();
        return response()->json(['message' => 'Comment deleted successfully.']);
    }
}
