<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Models\Client;
use App\Models\Material;
use Illuminate\Http\Request;
use App\Mail\ProjectAssignedMail;
use Illuminate\Support\Facades\Mail;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $clients = Client::all();
        $engineers = User::where('role', 'Engineer')->get();
        $materials = Material::all(); // Ambil semua material dari database

        // Query dasar
        $query = Project::with('client');

        // Sorting berdasarkan parameter
        if ($request->has('sort_by')) {
            $sortBy = $request->sort_by;
            $order = $request->has('order') && in_array($request->order, ['asc', 'desc']) ? $request->order : 'asc';

            if ($sortBy === 'project_name') {
                $query->orderBy('project_name', $order);
            } elseif ($sortBy === 'client_name') {
                $query->join('clients', 'projects.id_client', '=', 'clients.id_client')
                      ->orderBy('clients.client_fullname', $order)
                      ->select('projects.*');
            }
        }

        // Filter berdasarkan status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan due date
        if ($request->has('due_date') && $request->due_date != '') {
            if ($request->due_date == 'today') {
                $query->whereDate('end_date', now()->toDateString());
            } elseif ($request->due_date == 'this_week') {
                $query->whereBetween('end_date', [now()->startOfWeek(), now()->endOfWeek()]);
            } elseif ($request->due_date == 'this_month') {
                $query->whereMonth('end_date', now()->month)->whereYear('end_date', now()->year);
            }
        }

        // Pencarian berdasarkan nama proyek
        if ($request->has('search') && $request->search != '') {
            $query->where('project_name', 'like', '%' . $request->search . '%');
        }

        // Ambil data dengan pagination
        $projects = $query->paginate(10);

        return view('projects.index', compact('clients', 'engineers', 'materials', 'projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get all clients and users
        $clients = Client::all();
        $engineers = User::where('role', 'Engineer')->get();
        $materials = Material::all(); // Ambil semua material dari database

        return view('projects.create', compact('clients', 'engineers', 'materials'));
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
            'file_workorder' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'id_client' => 'required|exists:clients,id_client',
            'id_user' => 'required|exists:users,id_user',
            'materials' => 'nullable|array',
            'materials.*' => 'exists:materials,id_material',
        ]);

        // Simpan file workorder
        $filePath = $request->file('file_workorder')->store('workorders', 'public');
        $data['file_workorder'] = $filePath;

        // Simpan data ke database
        $project = Project::create($data);

        if ($request->has('materials')) {
            $project->materials()->sync($request->materials);
        }

        // Kirim email ke Engineer
        Mail::to($project->user->email)->send(new ProjectAssignedMail($project));

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('projects.index')->with('success', 'Project added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $materials = $project->materials; // Ambil material yang terkait dengan proyek

        return view('projects.show', compact('project', 'materials'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        // Get all clients and users
        $clients = Client::all();
        $engineers = User::where('role', 'Engineer')->get();
        $materials = Material::all();
        $selectedMaterials = $project->materials->pluck('id_material')->toArray(); // Ambil material yang sudah dipilih

        return view('projects.edit', compact('project', 'clients', 'engineers', 'materials', 'selectedMaterials'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'project_name' => 'required|string|max:255',
            'cost' => 'required|numeric',
            'complexity' => 'required|in:low,medium,high',
            'status' => 'required|in:notstarted,onprogress,pending,canceled,completed',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'id_client' => 'required|exists:clients,id_client',
            'id_user' => 'required|exists:users,id_user',
            'materials' => 'nullable|array',
            'materials.*' => 'exists:materials,id_material',
        ]);

        $project->update($data);

        if ($request->has('materials')) {
            $project->materials()->sync($request->materials);
        } else {
            $project->materials()->detach(); // Hapus semua material jika tidak ada yang dipilih
        }

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
