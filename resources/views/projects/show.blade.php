@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">{{ $project->project_name }}</h1>

        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Project Details</h2>
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

        <div class="mt-6">
            <h3 class="text-lg font-medium text-gray-700">Materials</h3>
            @if ($materials->isEmpty())
                <p class="text-sm text-gray-500">No materials selected.</p>
            @else
                <ul class="list-disc pl-5">
                    @foreach ($materials as $material)
                        <li class="text-sm text-gray-700">{{ $material->material_name }} ({{ $material->quantity }} available)</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="mt-6 flex gap-4">
            <a href="{{ route('projects.index') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">
                Back to Projects
            </a>
            <a href="{{ route('projects.documentations', $project->id_project) }}" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">
                Documentations
            </a>
            @if (auth()->user()->role === 'Engineer')
                <button type="button" data-modal-target="updateStatusModal" data-modal-toggle="updateStatusModal" class="text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">
                    Update Status
                </button>
            @endif
        </div>
    </div>

    <!-- Modal Update Status -->
    <div id="updateStatusModal" tabindex="-1" aria-hidden="true" class="fixed inset-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-[calc(100%)] max-h-full bg-gray-900 bg-opacity-50 backdrop-blur-sm">
        <div class="relative w-full max-w-md max-h-full mx-auto">
            <div class="relative bg-white rounded-lg shadow">
                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Update Project Status
                    </h3>
                </div>
                <div class="p-6">
                    <form method="POST" action="{{ route('projects.updateStatus', $project->id_project) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                <option value="notstarted" {{ $project->status === 'notstarted' ? 'selected' : '' }}>Not Started</option>
                                <option value="onprogress" {{ $project->status === 'onprogress' ? 'selected' : '' }}>On Progress</option>
                                <option value="pending" {{ $project->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="canceled" {{ $project->status === 'canceled' ? 'selected' : '' }}>Canceled</option>
                                <option value="completed" {{ $project->status === 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </div>
                        <div class="flex justify-end">
                            <button type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 rounded-lg text-sm px-5 py-2.5 mr-2 focus:outline-none" data-modal-hide="updateStatusModal">Cancel</button>
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg text-sm px-5 py-2.5 focus:outline-none">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection