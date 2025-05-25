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
        $clients = Client::all();
        $engineers = User::where('role', 'Engineer')->get(); // Ambil user dengan role engineer
        $projects = Project::with('client')->paginate(10);

        return view('projects.index', compact('clients', 'engineers', 'projects'));
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
        // Validasi input
        $data = $request->validate([
            'project_name' => 'required|string|max:255',
            'cost' => 'required|numeric',
            'complexity' => 'required|in:low,medium,high',
            'status' => 'required|in:notstarted,onprogress,pending,canceled,completed',
            'description' => 'required|string',
            'file_workorder' => 'required|file|mimes:pdf,doc,docx|max:2048', // File harus berupa PDF atau DOC
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'id_client' => 'required|exists:clients,id_client', // Perbaiki kolom di sini
            'id_user' => 'required|exists:users,id_user', // Validasi untuk PIC
        ]);

        // Simpan file workorder
        $filePath = $request->file('file_workorder')->store('workorders', 'public');
        $data['file_workorder'] = $filePath;

        // Simpan data ke database
        $project = Project::create($data);
        // dd($project);

        if (!$project) {
            return redirect()->back()->with('error', 'Failed to save project.');
        }

        // Redirect ke halaman index dengan pesan sukses
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
            'id_client' => 'required|exists:clients,id_client', // Perbaiki kolom di sini
            'id_user' => 'required|exists:users,id_user', // Validasi untuk PIC
            'project_name' => 'required|string|max:255',
            'cost' => 'required|numeric',
            'complexity' => 'required|in:low,medium,high',
            'status' => 'required|in:notstarted,onprogress,pending,canceled,completed',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
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
