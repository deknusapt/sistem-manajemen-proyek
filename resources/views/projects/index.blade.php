@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Projects</h1>

        <!-- Tombol untuk membuka modal -->
        @if (auth()->user()->role === 'ProjectManager')
            <div class="mb-4">
                <button data-modal-target="createProjectModal" data-modal-toggle="createProjectModal" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none">
                    New Project
                </button>
            </div>
        @endif

        <!-- Modal untuk form create project -->
        <div id="createProjectModal" tabindex="-1" aria-hidden="true" class="fixed inset-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-[calc(100%-1rem)] max-h-full bg-gray-900 bg-opacity-50 backdrop-blur-sm">
            <div class="relative w-full max-w-2xl max-h-full mx-auto">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t">
                        <h3 class="text-xl font-semibold text-gray-900">
                            Create New Project
                        </h3>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6">
                        <form method="POST" action="{{ route('projects.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label for="project_name" class="block text-sm font-medium text-gray-700">Project Name</label>
                                <input type="text" name="project_name" id="project_name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            </div>
                            <div class="mb-4">
                                <label for="id_client" class="block text-sm font-medium text-gray-700">Client</label>
                                <select name="id_client" id="id_client" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                    <option value="" disabled selected>Select a client</option>
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->id_client }}">{{ $client->client_fullname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                                <input type="date" name="start_date" id="start_date" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            </div>
                            <div class="mb-4">
                                <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                                <input type="date" name="end_date" id="end_date" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            </div>
                            <div class="mb-4">
                                <label for="complexity" class="block text-sm font-medium text-gray-700">Complexity</label>
                                <select name="complexity" id="complexity" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                    <option value="low">Low</option>
                                    <option value="medium">Medium</option>
                                    <option value="high">High</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="id_user" class="block text-sm font-medium text-gray-700">PIC (Engineer)</label>
                                <select name="id_user" id="id_user" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                    <option value="" disabled selected>Select an engineer</option>
                                    @foreach ($engineers as $engineer)
                                        <option value="{{ $engineer->id_user }}">{{ $engineer->fullname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                <select name="status" id="status" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                    <option value="" disabled selected>Select a status</option>
                                    <option value="notstarted">Not Started</option>
                                    <option value="onprogress">On Progress</option>
                                    <option value="pending">Pending</option>
                                    <option value="canceled">Canceled</option>
                                    <option value="completed">Completed</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="cost" class="block text-sm font-medium text-gray-700">Cost</label>
                                <input type="number" name="cost" id="cost" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Enter project cost" required>
                            </div>
                            <div class="mb-4">
                                <label for="file_workorder" class="block text-sm font-medium text-gray-700">File Workorder</label>
                                <input type="file" name="file_workorder" id="file_workorder" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            </div>
                            <div class="mb-4">
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea name="description" id="description" rows="4" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Enter project description"></textarea>
                            </div>
                            <div class="flex justify-end mt-6">
                                <button type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 rounded-lg text-sm px-5 py-2.5 mr-2 focus:outline-none" data-modal-hide="createProjectModal">Cancel</button>
                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg text-sm px-5 py-2.5 focus:outline-none">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Konfirmasi Hapus -->
        <div id="deleteConfirmationModal" tabindex="-1" aria-hidden="true" class="fixed inset-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-[calc(100%-1rem)] max-h-full bg-gray-900 bg-opacity-50 backdrop-blur-sm">
            <div class="relative w-full max-w-md max-h-full mx-auto">
                <div class="relative bg-white rounded-lg shadow">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t">
                        <h3 class="text-xl font-semibold text-gray-900">
                            Confirm Deletion
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="deleteConfirmationModal">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6">
                        <p class="text-sm text-gray-500">
                            Are you sure you want to delete this project? This action cannot be undone.
                        </p>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center justify-end p-6 space-x-2 border-t border-gray-200 rounded-b">
                        <button data-modal-hide="deleteConfirmationModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 rounded-lg text-sm px-5 py-2.5 mr-2 focus:outline-none">Cancel</button>
                        <form id="deleteForm" method="POST" action="">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 rounded-lg text-sm px-5 py-2.5 focus:outline-none">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk Edit Project -->
        <div id="editProjectModal" tabindex="-1" aria-hidden="true" class="fixed inset-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-[calc(100%-1rem)] max-h-full bg-gray-900 bg-opacity-50 backdrop-blur-sm">
            <div class="relative w-full max-w-2xl max-h-full mx-auto">
                <div class="relative bg-white rounded-lg shadow">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t">
                        <h3 class="text-xl font-semibold text-gray-900">
                            Edit Project
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="editProjectModal">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6">
                        <form id="editForm" method="POST" action="" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label for="edit_project_name" class="block text-sm font-medium text-gray-700">Project Name</label>
                                <input type="text" name="project_name" id="edit_project_name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            </div>
                            <div class="mb-4">
                                <label for="edit_id_client" class="block text-sm font-medium text-gray-700">Client</label>
                                <select name="id_client" id="edit_id_client" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                    <option value="" disabled>Select a client</option>
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->id_client }}">{{ $client->client_fullname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="edit_start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                                <input type="date" name="start_date" id="edit_start_date" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            </div>
                            <div class="mb-4">
                                <label for="edit_end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                                <input type="date" name="end_date" id="edit_end_date" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            </div>
                            <div class="mb-4">
                                <label for="edit_complexity" class="block text-sm font-medium text-gray-700">Complexity</label>
                                <select name="complexity" id="edit_complexity" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                    <option value="low">Low</option>
                                    <option value="medium">Medium</option>
                                    <option value="high">High</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="edit_id_user" class="block text-sm font-medium text-gray-700">PIC (Engineer)</label>
                                <select name="id_user" id="edit_id_user" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                    <option value="" disabled>Select an engineer</option>
                                    @foreach ($engineers as $engineer)
                                        <option value="{{ $engineer->id_user }}">{{ $engineer->fullname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="edit_status" class="block text-sm font-medium text-gray-700">Status</label>
                                <select name="status" id="edit_status" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                    <option value="notstarted">Not Started</option>
                                    <option value="onprogress">On Progress</option>
                                    <option value="pending">Pending</option>
                                    <option value="canceled">Canceled</option>
                                    <option value="completed">Completed</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="edit_cost" class="block text-sm font-medium text-gray-700">Cost</label>
                                <input type="number" name="cost" id="edit_cost" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            </div>
                            <div class="mb-4">
                                <label for="edit_description" class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea name="description" id="edit_description" rows="4" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                            </div>
                            <div class="flex justify-end mt-6">
                                <button type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 rounded-lg text-sm px-5 py-2.5 mr-2 focus:outline-none" data-modal-hide="editProjectModal">Cancel</button>
                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg text-sm px-5 py-2.5 focus:outline-none">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Project -->
        <div class="relative overflow-x-auto sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center">Project Name</th>
                        <th scope="col" class="px-6 py-3 text-center">Client</th>
                        <th scope="col" class="px-6 py-3 text-center">Start Date</th>
                        <th scope="col" class="px-6 py-3 text-center">End Date</th>
                        <th scope="col" class="px-6 py-3 text-center">Status</th>
                        <th scope="col" class="px-6 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr class="bg-white border-b">
                            <td class="px-6 py-4">
                                <a href="{{ route('projects.show', $project->id_project) }}" class="text-blue-600 hover:underline">
                                    {{ $project->project_name }}
                                </a>
                            </td>
                            <td class="px-6 py-4">{{ $project->client->client_fullname }}</td>
                            <td class="px-6 py-4 text-center">{{ $project->start_date }}</td>
                            <td class="px-6 py-4 text-center">{{ $project->end_date }}</td>
                            <td class="px-6 py-4">
                                @if ($project->status === 'notstarted')
                                    <span class="bg-gray-500 text-white text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Not Started</span>
                                @elseif ($project->status === 'onprogress')
                                    <span class="bg-blue-500 text-white text-xs font-medium mr-2 px-2.5 py-0.5 rounded">On Progress</span>
                                @elseif ($project->status === 'pending')
                                    <span class="bg-yellow-500 text-white text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Pending</span>
                                @elseif ($project->status === 'canceled')
                                    <span class="bg-red-500 text-white text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Canceled</span>
                                @elseif ($project->status === 'completed')
                                    <span class="bg-green-500 text-white text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Completed</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 flex gap-2 justify-center">
                                <button type="button" 
                                    class="edit-button text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none"
                                    data-project-id="{{ $project->id_project }}"
                                    data-project-name="{{ $project->project_name }}"
                                    data-client-id="{{ $project->id_client }}"
                                    data-start-date="{{ $project->start_date }}"
                                    data-end-date="{{ $project->end_date }}"
                                    data-complexity="{{ $project->complexity }}"
                                    data-user-id="{{ $project->id_user }}"
                                    data-status="{{ $project->status }}"
                                    data-cost="{{ $project->cost }}"
                                    data-description="{{ $project->description }}">
                                    Edit
                                </button>

                                @if (auth()->user()->role !== 'Engineer')
                                    <button type="button" 
                                        class="delete-button text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none" 
                                        data-project-id="{{ $project->id_project }}">
                                        Delete
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <nav class="flex justify-between items-center pt-4" aria-label="Table navigation">
            <span class="text-sm font-normal text-gray-500">Showing {{ $projects->firstItem() }}-{{ $projects->lastItem() }} of {{ $projects->total() }}</span>
            <ul class="inline-flex items-center -space-x-px">
                {{ $projects->links('pagination::bootstrap-4') }}
            </ul>
        </nav>
    </div>

    @vite('resources/js/projects.js')
@endsection
