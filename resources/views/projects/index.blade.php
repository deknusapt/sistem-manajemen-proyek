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
        <div id="createProjectModal" tabindex="-1" aria-hidden="true" class="fixed inset-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-[calc(100%)] max-h-full bg-gray-900 bg-opacity-50 backdrop-blur-sm">
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
                                <input type="text" name="project_name" id="project_name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Enter project name" required>
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
                            <div class="mb-4">
                                <label for="materials" class="block text-sm font-medium text-gray-700">Materials</label>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach ($materials as $material)
                                        <div class="flex items-center">
                                            <input type="checkbox" name="materials[]" id="material_{{ $material->id_material }}" value="{{ $material->id_material }}" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                            <label for="material_{{ $material->id_material }}" class="ml-2 text-sm text-gray-700">{{ $material->material_name }} ({{ $material->quantity }} available)</label>
                                        </div>
                                    @endforeach
                                </div>
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
        <div id="deleteConfirmationModal" tabindex="-1" aria-hidden="true" class="fixed inset-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-[calc(100%)] max-h-full bg-gray-900 bg-opacity-50 backdrop-blur-sm">
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
                            Are you sure you want to delete <strong>this project?</strong> This action cannot be undone.
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
        <div id="editProjectModal" tabindex="-1" aria-hidden="true" class="fixed inset-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-[calc(100%)] max-h-full bg-gray-900 bg-opacity-50 backdrop-blur-sm">
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
                            <div class="mb-4">
                                <label for="materials" class="block text-sm font-medium text-gray-700">Materials</label>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach ($materials as $material)
                                        <div class="flex items-center">
                                            <input type="checkbox" name="materials[]" id="material_{{ $material->id_material }}" value="{{ $material->id_material }}" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                                {{ isset($selectedMaterials) && in_array($material->id_material, $selectedMaterials) ? 'checked' : '' }}>
                                            <label for="material_{{ $material->id_material }}" class="ml-2 text-sm text-gray-700">{{ $material->material_name }} ({{ $material->quantity }} available)</label>
                                        </div>
                                    @endforeach
                                </div>
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

        <!-- Filter dan Pencarian -->
        <div class="mb-4 flex justify-between">
            <form method="GET" action="{{ route('projects.index') }}" class="flex gap-4">
                <!-- Sorting -->
                <div>
                    <label for="sort_by" class="block text-sm font-medium text-gray-700">Sort By</label>
                    <select name="sort_by" id="sort_by" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-4 py-2">
                        <option value="">None</option>
                        <option value="project_name" {{ request('sort_by') == 'project_name' ? 'selected' : '' }}>Project Name</option>
                        <option value="client_name" {{ request('sort_by') == 'client_name' ? 'selected' : '' }}>Client Name</option>
                    </select>
                </div>

                <!-- Filter Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-4 py-2">
                        <option value="">All</option>
                        <option value="notstarted" {{ request('status') == 'notstarted' ? 'selected' : '' }}>Not Started</option>
                        <option value="onprogress" {{ request('status') == 'onprogress' ? 'selected' : '' }}>On Progress</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="canceled" {{ request('status') == 'canceled' ? 'selected' : '' }}>Canceled</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>

                <!-- Filter Due Date -->
                <div>
                    <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date</label>
                    <select name="due_date" id="due_date" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-4 py-2">
                        <option value="">All</option>
                        <option value="today" {{ request('due_date') == 'today' ? 'selected' : '' }}>This Day</option>
                        <option value="this_week" {{ request('due_date') == 'this_week' ? 'selected' : '' }}>This Week</option>
                        <option value="this_month" {{ request('due_date') == 'this_month' ? 'selected' : '' }}>This Month</option>
                    </select>
                </div>

                <!-- Order -->
                <div>
                    <label for="order" class="block text-sm font-medium text-gray-700">Order</label>
                    <select name="order" id="order" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-4 py-2">
                        <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>A - Z</option>
                        <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>Z - A</option>
                    </select>
                </div>

                <!-- Tombol Submit -->
                <div class="flex items-end">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none">
                        Filter
                    </button>
                </div>
            </form>

            <!-- Pencarian -->
            <form method="GET" action="{{ route('projects.index') }}" class="flex items-end">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search projects..." class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-4 py-2"/>
                <button type="submit" class="ml-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none">
                    Search
                </button>
            </form>
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
                        @if (auth()->user()->role !== 'Engineer')
                        <th scope="col" class="px-6 py-3 text-center">Actions</th>
                        @endif
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
                            @if (auth()->user()->role !== 'Engineer')
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

                                    <button type="button" 
                                        class="delete-button text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none" 
                                        data-project-id="{{ $project->id_project }}">
                                        Delete
                                    </button>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <nav class="flex justify-between items-center pt-4" aria-label="Table navigation">
            <span class="text-sm font-normal text-gray-500">Showing {{ $projects->firstItem() }}-{{ $projects->lastItem() }} of {{ $projects->total() }}</span>
            <ul class="inline-flex items-center -space-x-px">
                @if ($projects->onFirstPage())
                    <li>
                        <span class="px-3 py-2 ml-0 leading-tight text-gray-500 bg-gray-200 border border-gray-300 rounded-l-lg cursor-not-allowed">Previous</span>
                    </li>
                @else
                    <li>
                        <a href="{{ $projects->previousPageUrl() }}" class="px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700">Previous</a>
                    </li>
                @endif

                @foreach ($projects->getUrlRange(1, $projects->lastPage()) as $page => $url)
                    @if ($page == $projects->currentPage())
                        <li>
                            <span class="px-3 py-2 leading-tight text-white bg-blue-600 border border-gray-300">{{ $page }}</span>
                        </li>
                    @else
                        <li>
                            <a href="{{ $url }}" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach

                @if ($projects->hasMorePages())
                    <li>
                        <a href="{{ $projects->nextPageUrl() }}" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700">Next</a>
                    </li>
                @else
                    <li>
                        <span class="px-3 py-2 leading-tight text-gray-500 bg-gray-200 border border-gray-300 rounded-r-lg cursor-not-allowed">Next</span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>

    @vite('resources/js/projects.js')
@endsection
