@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Documentations for {{ $project->project_name }}</h1>

        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Project Details</h2>
            <p><strong>Client:</strong> {{ $project->client->client_fullname }}</p>
            <p><strong>Description:</strong> {{ $project->description }}</p>
        </div>

        <div class="mt-6">
            <h3 class="text-lg font-semibold mb-4">Documentations</h3>
            @if ($documentations->isEmpty())
                <p>No documentations available for this project.</p>
            @else
                <ul class="list-disc pl-6">
                    @foreach ($documentations as $documentation)
                        <li>
                            <a href="{{ asset('storage/' . $documentation->file_photos) }}" target="_blank" class="text-blue-600 hover:underline">
                                {{ $documentation->description }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="mt-6">
            <a href="{{ route('projects.show', $project->id_project) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">
                Back to Project Details
            </a>
        </div>
    </div>
@endsection