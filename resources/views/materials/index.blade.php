@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Materials</h1>

        <div class="mb-4">
            <a href="/materials/create" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">New Material</a>
        </div>

        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Material Name</th>
                    <th class="py-2 px-4 border-b">Quantity</th>
                    <th class="py-2 px-4 border-b">Unit</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($materials as $material)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $material->material_name }}</td>
                        <td class="py-2 px-4 border-b">{{ $material->quantity }}</td>
                        <td class="py-2 px-4 border-b">{{ $material->unit }}</td>
                        <td class="py-2 px-4 border-b">
                            <a href="/materials/{{ $material->id }}/edit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit</a>
                            <form action="/materials/{{ $material->id }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $materials->links() }}
    </div>
@endsection
