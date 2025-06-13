<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documentation;
use App\Models\Project;
use App\Models\User;

class DocumentationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($projectId)
    {
        // Get all documentations related to a specific project
        $documentations = Documentation::where('id_project', $projectId)->get();
        $project = Project::findOrFail($projectId); // Get related project

        return view('documentations.index', compact('documentations', 'project'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($projectId)
    {
        $project = Project::findOrFail($projectId); // Get related project
        $users = User::all(); // Get all users for PIC selection

        return view('documentations.create', compact('project', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'doc_name' => 'required|string|max:255',
            'description' => 'required|string',
            'file_photos' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'id_project' => 'required|exists:projects,id_project',
            'id_user' => 'required|exists:users,id_user',
        ]);

        // Handle file upload
        $filePath = $request->file('file_photos')->store('documentations', 'public');

        // Create documentation
        Documentation::create([
            'doc_name' => $request->doc_name,
            'description' => $request->description,
            'file_photos' => $filePath,
            'status' => 'needreview', // Set status automatically
            'date_submitted' => now(),
            'id_project' => $request->id_project,
            'id_user' => $request->id_user,
        ]);

        return redirect()->route('projects.documentations', $request->id_project)->with('success', 'Documentation added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $documentation = Documentation::findOrFail($id);

        return view('documentations.show', compact('documentation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $documentation = Documentation::findOrFail($id);
        $project = $documentation->project;
        $users = User::all(); // Get all users for PIC selection

        return view('documentations.edit', compact('documentation', 'project', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'doc_name' => 'required|string|max:255',
            'description' => 'required|string',
            'file_photos' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'status' => 'required|in:needreview,accepted,revision',
        ]);

        $documentation = Documentation::findOrFail($id);

        // Handle file upload if provided
        if ($request->hasFile('file_photos')) {
            $filePath = $request->file('file_photos')->store('documentations', 'public');
            $documentation->file_photos = $filePath;
        }

        // Update documentation
        $documentation->update([
            'doc_name' => $request->doc_name,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('projects.documentations', $documentation->id_project)->with('success', 'Documentation updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $documentation = Documentation::findOrFail($id);
        $projectId = $documentation->id_project;

        // Delete documentation
        $documentation->delete();

        // Redirect to the correct route
        return redirect()->route('projects.documentations', $projectId)->with('success', 'Documentation deleted successfully.');
    }
}
