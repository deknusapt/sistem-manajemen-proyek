<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Query dasar
        $query = Client::query();

        // Pencarian berdasarkan fullname
        if ($request->has('search') && $request->search != '') {
            $query->where('client_fullname', 'like', '%' . $request->search . '%');
        }

        // Sorting berdasarkan fullname
        if ($request->has('sort_by') && $request->sort_by == 'fullname') {
            $order = $request->has('order') && $request->order == 'desc' ? 'desc' : 'asc';
            $query->orderBy('client_fullname', $order);
        }

        // Sorting berdasarkan company
        if ($request->has('sort_by') && $request->sort_by == 'company') {
            $order = $request->has('order') && $request->order == 'desc' ? 'desc' : 'asc';
            $query->orderBy('company', $order);
        }

        // Ambil data dengan pagination
        $clients = $query->paginate(10);

        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return the view to create a new client
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'client_fullname' => 'required',
            'company' => 'required',
            'position' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email|unique:clients',
        ]);

        Client::create($request->all());

        return redirect()->route('clients.index')->with('success', 'Client added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        // Return the view to show a specific client
        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        // Return the view to edit a specific client
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        // Validate the request
        $request->validate([
            'client_fullname' => 'required',
            'company' => 'required',
            'position' => 'required',
            'address' => 'required',
            'phone_number' => 'required|numeric',
            'email' => 'required|email|unique:clients,email,' . $client->id_client . ',id_client'
        ]);

        // Update the client
        $client->update($request->all());

        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        // Delete the client
        $client->delete();

        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }
}
