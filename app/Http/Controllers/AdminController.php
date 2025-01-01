<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index()
    {
        $admins = _admin::all();
        return response()->json($admins);
    }

    public function show($id)
    {
        $admin = _admin::findOrFail($id);
        return response()->json($admin);
    }
}
