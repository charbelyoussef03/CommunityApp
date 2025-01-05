<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\_comment;
class CommentController extends Controller
{
    //
    public function index()
    {
       $Allcomments = _comment::all();
       return response()->json($Allcomments,201);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Content' => 'required|string',
            'PostId' => 'required|exists:_post,id',
            'UserId' => 'required|exists:_person,id',
            'IsFlagged' => 'required|boolean',
            'LikesCount' => 'required|integer'
        ]);

        $comment = _comment::create($validated);
        return response()->json($comment, 201);
    }

    public function update(Request $request, $id)
    {
        $comment = _comment::findOrFail($id);

        $validated = $request->validate([
            'Content' => 'required|string',
            'IsFlagged' => 'required|boolean',
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
