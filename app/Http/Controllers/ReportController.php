<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function index()
    {
        $reports = _report::with(['person_reported', 'person_reporter'])->get();
        return response()->json($reports);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ReporterId' => 'required|exists:people,id',
            'ReportedId' => 'required|exists:people,id',
            'Reason' => 'required|string',
            'Status' => 'nullable|string',
        ]);

        $report = _report::create($validated);
        return response()->json($report, 201);
    }

    public function update(Request $request, $id)
    {
        $report = _report::findOrFail($id);

        $validated = $request->validate([
            'Status' => 'required|string',
        ]);

        $report->update($validated);
        return response()->json($report);
    }
}
