@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Project Details</h1>

        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">{{ $project->project_name }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p><strong>Client:</strong> {{ $project->client->client_fullname }}</p>
                    <p><strong>Start Date:</strong> {{ $project->start_date }}</p>
                    <p><strong>End Date:</strong> {{ $project->end_date }}</p>
                    <p><strong>Complexity:</strong> {{ ucfirst($project->complexity) }}</p>
                </div>
                <div>
                    <p><strong>PIC (Engineer):</strong> {{ $project->user->fullname }}</p>
                    <p><strong>Status:</strong> 
                        @if ($project->status === 'notstarted')
                            <span class="bg-gray-500 text-white text-xs font-medium px-2.5 py-0.5 rounded">Not Started</span>
                        @elseif ($project->status === 'onprogress')
                            <span class="bg-blue-500 text-white text-xs font-medium px-2.5 py-0.5 rounded">On Progress</span>
                        @elseif ($project->status === 'pending')
                            <span class="bg-yellow-500 text-white text-xs font-medium px-2.5 py-0.5 rounded">Pending</span>
                        @elseif ($project->status === 'canceled')
                            <span class="bg-red-500 text-white text-xs font-medium px-2.5 py-0.5 rounded">Canceled</span>
                        @elseif ($project->status === 'completed')
                            <span class="bg-green-500 text-white text-xs font-medium px-2.5 py-0.5 rounded">Completed</span>
                        @endif
                    </p>
                    <p><strong>Cost:</strong> Rp {{ number_format($project->cost, 0, ',', '.') }}</p>
                </div>
            </div>
            <div class="mt-4">
                <p><strong>Description:</strong></p>
                <p>{{ $project->description }}</p>
            </div>
            <div class="mt-6">
                <a href="{{ asset('storage/' . $project->file_workorder) }}" target="_blank" class="text-blue-600 hover:underline">Download Workorder</a>
            </div>
        </div>

        <div class="mt-6 flex gap-4">
            <a href="{{ route('projects.index') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">
                Back to Projects
            </a>
            <a href="{{ route('projects.documentations', $project->id_project) }}" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">
                Documentations
            </a>
        </div>
    </div>
@endsection