<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\_person; 
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
    public function getAuthenticatedUser()
    {
        $user = Auth::user();
       
        if ($user) {
            return response()->json($user);
        } else {
            return response()->json(['error' => 'User not authenticated'], 401);
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
    //register a user
    public function register(Request $request)
    {
        $validated = $request->validate([
            'Name' => 'required|string|max:255',
            'LastName' => 'required|string',
            'Email' => 'sometimes|email|unique:_person,email,',
            'PassWord' => 'required|string',
            'DateOfBirth' => 'required|string',
        ]);

        $validated['PassWord'] = bcrypt($validated['PassWord']);
        $person = _person::create($validated);

        return response()->json([
            'message' => 'User registered successfully.',
            'person' => $person,
        ], 201);
    }
    // login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'Name' => 'sometimes|string|max:255',
            'Email' => 'required|string|email',
            'PassWord' => 'required|string',
        ]);

        $person = _person::where('Email', $credentials['Email'])->first();

        if (!$person || !Hash::check($credentials['PassWord'], $person->PassWord)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $person->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
        'token_type' => 'Bearer',
        ]);
    }
    //logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully']);
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
