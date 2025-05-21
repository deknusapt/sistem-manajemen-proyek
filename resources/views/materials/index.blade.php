@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Materials</h1>

        <div class="mb-4">
            <a href="/materials/create" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none">
                New Material
            </a>
        </div>

        <div class="relative overflow-x-auto sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center">Material Name</th>
                        <th scope="col" class="px-6 py-3 text-center">Quantity</th>
                        <th scope="col" class="px-6 py-3 text-center">Availability</th>
                        <th scope="col" class="px-6 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($materials as $material)
                        <tr class="bg-white border-b">
                            <td class="px-6 py-4">{{ $material->material_name }}</td>
                            <td class="px-6 py-4 text-center">{{ $material->quantity }}</td>
                            <td class="px-6 py-4 text-center">
                                @if ($material->availability === 'Available')
                                    <span class="bg-green-500 text-white text-xs font-medium mr-2 px-2.5 py-0.5 rounded">
                                        {{ $material->availability }}
                                    </span>
                                @else
                                    <span class="bg-gray-500 text-white text-xs font-medium mr-2 px-2.5 py-0.5 rounded">
                                        {{ $material->availability }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 flex gap-2 justify-center">
                                <a href="/materials/{{ $material->id }}/edit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none">
                                    Edit
                                </a>
                                <form action="/materials/{{ $material->id }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $materials->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
