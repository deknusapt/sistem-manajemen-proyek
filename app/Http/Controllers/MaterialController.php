<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\User;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Gunakan paginate() untuk pagination
        $materials = Material::with('client')->paginate(10); // 10 item per halaman
        return view('materials.index', compact('materials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get all clients and users
        $clients = Client::all();
        $users = User::whereIn('role', ['ProjectManager', 'Engineer'])->get();

        return view('materials.create', compact('clients', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'material_name' => 'required',
            'cost' => 'required|numeric',
            'quantity' => 'required|integer',
            'description' => 'required',
            'file_workorder' => 'required',
            'id_client' => 'required|exists:clients,id_client',
            'id_user' => 'required|exists:users,id_user'
        ]);

        // Create a new material
        Material::create($request->all());

        return redirect()->route('materials.index')->with('success', 'Material added successfully.');
    }

    /**
     * Display all materials.
     */
    public function show(Material $material)
    {
        // Get all materials
        // $materials = Material::with('client')->paginate(10); // 10 item per halaman
        return view('materials.show', compact('materials'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $material)
    {
        // Get all clients and users
        $clients = Client::all();
        $users = User::whereIn('role', ['ProjectManager', 'Engineer'])->get();

        return view('materials.edit', compact('material', 'clients', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Material $material)
    {
        // Validate the request
        $request->validate([
            'material_name' => 'required',
            'cost' => 'required|numeric',
            'quantity' => 'required|integer',
            'description' => 'required',
            'file_workorder' => 'required',
            'id_client' => 'required|exists:clients,id_client',
            'id_user' => 'required|exists:users,id_user'
        ]);

        // Update the material
        $material->update($request->all());

        return redirect()->route('materials.index')->with('success', 'Material updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Material $material)
    {
        // Delete the material
        $material->delete();

        return redirect()->route('materials.index')->with('success', 'Material deleted successfully.');
    }
}
