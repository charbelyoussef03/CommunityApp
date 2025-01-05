<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\_person; 
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PersonController extends Controller
{
    // Get all persons
    public function index()
    {
        $people = _person::all();
        return response()->json($people);
    }

    // Get a specific person by ID
    public function show($id)
    {
        try {
            $person = _person::findOrFail($id);
            return response()->json($person);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Person not found.'], 404);
        }
    }

    // Create a new person
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Name' => 'required|string|max:255',
            'LastName' => 'required|string',
            'Email' => 'sometimes|email|unique:_person,email,',
            'PassWord' => 'required|string',
            'DateOfBirth' => 'required|string',
            'IsBanned' => 'required|boolean',
           
        ]);
        $validated['PassWord'] = bcrypt($validated['PassWord']);
        $person = _person::create($validated);
        return response()->json($person, 201);
    }

    // Update an existing person
    public function update(Request $request, $id)
    {
        try {
            $person = _person::findOrFail($id);

            $validated = $request->validate([
                'Name' => 'sometimes|string|max:255',
                'Email' => 'sometimes|email|unique:_person,email,'. $id,
                'PassWord' => 'sometimes | string',
                'DateOfBirth' => 'required|string',
                'IsBanned' => 'required|boolean',
                
            ]);
            $validated['PassWord'] = bcrypt($validated['PassWord']);
            $person->update($validated);
            return response()->json($person);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Person not found.'], 404);
        }
    }

    // Delete a person
    public function destroy($id)
    {
        try {
            $person = _person::findOrFail($id);
            $person->delete();
            return response()->json(['message' => 'Person deleted successfully.']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Person not found.'], 404);
        }
    }
}
