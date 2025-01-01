<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VoteController extends Controller
{
    //
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string', // e.g., upvote or downvote
            'post_id' => 'required|exists:posts,id',
            'person_id' => 'required|exists:people,id',
        ]);

        $vote = _vote::create($validated);
        return response()->json($vote, 201);
    }

    public function destroy($id)
    {
        $vote = _vote::findOrFail($id);
        $vote->delete();
        return response()->json(['message' => 'Vote removed successfully.']);
    }
}
