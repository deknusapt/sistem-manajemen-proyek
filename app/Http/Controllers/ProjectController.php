<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all projects
        $projects = Project::with('user', 'client')->get();

        // Return the view to show all projects
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get all clients and users
        $clients = Client::all();
        $users = User::where('role', 'ProjectManager')->get();

        return view('projects.create', compact('clients', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'project_name' => 'required',
            'cost' => 'required|numeric',
            'complexity' => 'required|in:Low,Medium,High',
            'status' => 'required|in:notstarted,onprogress,pending,canceled',
            'description' => 'required',
            'file_workorder' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'id_client' => 'required|exists:clients,id_client',
            'id_user' => 'required|exists:users,id_user'
        ]);

        // Create a new project
        Project::create($request->all());

        return redirect()->route('projects.index')->with('success', 'Project added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        // Get all clients and users
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        // Get all clients and users
        $clients = Client::all();
        $users = User::where('role', 'ProjectManager')->get();

        return view('projects.edit', compact('project', 'clients', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        // Validate the request
        $request->validate([
            'project_name' => 'required',
            'cost' => 'required|numeric',
            'complexity' => 'required|in:Low,Medium,High',
            'status' => 'required|in:notstarted,onprogress,pending,canceled',
            'description' => 'required',
            'file_workorder' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'id_client' => 'required|exists:clients,id_client',
            'id_user' => 'required|exists:users,id_user'
        ]);

        // Update the project
        $project->update($request->all());

        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        // Delete the project
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
