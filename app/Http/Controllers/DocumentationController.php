<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documentation;

class DocumentationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($projectId)
    {
        // Get all documentations related to a specific project
        $documentations = Documentation::where('id_project', $projectId)->get();
        $project = $documentations->first()?->project; // Get related project (if any documentation exists)

        return view('documentations.index', compact('documentations', 'project'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return the view to create a new documentation
        return view('documentations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'doc_name' => 'required',
            'description' => 'required',
            'file_photos' => 'required',
            'status' => 'required|in:needreview,accepted,revision',
        ]);

        Documentation::create($request->all());

        return redirect()->route('documentations.index')->with('success', 'Documentation added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
