<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function index()
    {
        $people = _person::all();
        return response()->json($people);
    }

    public function show($id)
    {
        $person = _person::findOrFail($id);
        return response()->json($person);
    }
}
