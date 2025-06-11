<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Query dasar
        $query = Material::query();

        // Filter berdasarkan availability
        if ($request->has('availability') && $request->availability != '') {
            $query->where('availability', $request->availability);
        }

        // Pencarian berdasarkan nama material
        if ($request->has('search') && $request->search != '') {
            $query->where('material_name', 'like', '%' . $request->search . '%');
        }

        // Sorting berdasarkan nama atau quantity
        if ($request->has('sort_by') && $request->sort_by != '') {
            $order = $request->has('order') && in_array($request->order, ['asc', 'desc']) ? $request->order : 'asc';
            $query->orderBy($request->sort_by, $order);
        } else {
            // Default sorting jika sort_by tidak diberikan
            $query->orderBy('material_name', 'asc');
        }

        // Ambil data dengan pagination
        $materials = $query->paginate(10);

        return view('materials.index', compact('materials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('materials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'material_name' => 'required|string|max:255',
            'brandname' => 'required|string|max:255',
            'serial_number' => 'required|string|max:255|unique:materials,serial_number',
            'quantity' => 'required|integer|min:0',
            'availability' => 'required|in:Available,OutofStock',
        ]);

        // Create a new material
        Material::create($request->all());

        return redirect()->route('materials.index')->with('success', 'Material added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Material $material)
    {
        return view('materials.show', compact('material'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $material)
    {
        return view('materials.edit', compact('material'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Material $material)
    {
        // Validasi data
        $request->validate([
            'material_name' => 'required|string|max:255',
            'brandname' => 'required|string|max:255',
            'serial_number' => 'required|string|max:255|unique:materials,serial_number,' . $material->id_material . ',id_material',
            'quantity' => 'required|integer|min:0',
            'availability' => 'required|in:Available,OutofStock',
        ]);

        // Update material
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
