@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Documentation Details</h1>

        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">{{ $documentation->doc_name }}</h2>
            <p class="text-sm text-gray-600 mb-4">{{ $documentation->description }}</p>
            <p class="text-xs text-gray-500 mb-4">Submitted by: {{ $documentation->user->fullname }} on {{ $documentation->date_submitted }}</p>
            <p class="text-xs text-gray-500 mb-4">PIC (Person in Charge): <span class="font-semibold">{{ $documentation->user->fullname }}</span></p>
            <p class="text-xs text-gray-500 mb-4">Status: <span class="font-semibold">{{ ucfirst($documentation->status) }}</span></p>

            @if ($documentation->file_photos)
                <div class="mb-4">
                    <h3 class="text-lg font-semibold">Attached File:</h3>
                    <a href="{{ asset('storage/' . $documentation->file_photos) }}" target="_blank" class="text-blue-600 hover:underline">
                        View File
                    </a>
                </div>
            @endif

            <div class="flex gap-4">
                <a href="{{ route('documentations.edit', $documentation->id_doc) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">
                    Edit
                </a>
                <form method="POST" action="{{ route('documentations.destroy', $documentation->id_doc) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection