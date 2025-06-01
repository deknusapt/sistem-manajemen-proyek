@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Materials</h1>

        <div class="mb-4">
            <a href="#" data-modal-target="createMaterialModal" data-modal-toggle="createMaterialModal" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none">
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
                                    <span class="bg-green-500 text-white text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Available</span>
                                @else
                                    <span class="bg-gray-500 text-white text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Out of Stock</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 flex gap-2 justify-center">
                                <button type="button" 
                                    class="edit-button text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none"
                                    data-material-id="{{ $material->id_material }}"
                                    data-material-name="{{ $material->material_name }}"
                                    data-brandname="{{ $material->brandname }}"
                                    data-serial-number="{{ $material->serial_number }}"
                                    data-quantity="{{ $material->quantity }}"
                                    data-availability="{{ $material->availability }}">
                                    Edit
                                </button>
                                <button type="button" 
                                    class="delete-button text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none" 
                                    data-material-id="{{ $material->id_material }}">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <nav class="flex justify-between items-center pt-4" aria-label="Table navigation">
            <span class="text-sm font-normal text-gray-500">Showing {{ $materials->firstItem() }}-{{ $materials->lastItem() }} of {{ $materials->total() }}</span>
            <ul class="inline-flex items-center -space-x-px">
                @if ($materials->onFirstPage())
                    <li>
                        <span class="px-3 py-2 ml-0 leading-tight text-gray-500 bg-gray-200 border border-gray-300 rounded-l-lg cursor-not-allowed">Previous</span>
                    </li>
                @else
                    <li>
                        <a href="{{ $materials->previousPageUrl() }}" class="px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700">Previous</a>
                    </li>
                @endif

                @foreach ($materials->getUrlRange(1, $materials->lastPage()) as $page => $url)
                    @if ($page == $materials->currentPage())
                        <li>
                            <span class="px-3 py-2 leading-tight text-white bg-blue-600 border border-gray-300">{{ $page }}</span>
                        </li>
                    @else
                        <li>
                            <a href="{{ $url }}" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach

                @if ($materials->hasMorePages())
                    <li>
                        <a href="{{ $materials->nextPageUrl() }}" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700">Next</a>
                    </li>
                @else
                    <li>
                        <span class="px-3 py-2 leading-tight text-gray-500 bg-gray-200 border border-gray-300 rounded-r-lg cursor-not-allowed">Next</span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>

    <!-- Modal untuk form create material -->
    <div id="createMaterialModal" tabindex="-1" aria-hidden="true" class="fixed inset-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-[calc(100%-1rem)] max-h-full bg-gray-900 bg-opacity-50 backdrop-blur-sm">
        <div class="relative w-full max-w-2xl max-h-full mx-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Create New Material
                    </h3>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <form method="POST" action="{{ route('materials.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="material_name" class="block text-sm font-medium text-gray-700">Material Name</label>
                            <input type="text" name="material_name" id="material_name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Enter material name" required>
                        </div>
                        <div class="mb-4">
                            <label for="brandname" class="block text-sm font-medium text-gray-700">Brand Name</label>
                            <input type="text" name="brandname" id="brandname" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Enter brandname" required>
                        </div>
                        <div class="mb-4">
                            <label for="serial_number" class="block text-sm font-medium text-gray-700">Serial Number</label>
                            <input type="text" name="serial_number" id="serial_number" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Enter serial number" required>
                        </div>
                        <div class="mb-4">
                            <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                            <input type="number" name="quantity" id="quantity" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Enter quantity" required>
                        </div>
                        <div class="mb-4">
                            <label for="availability" class="block text-sm font-medium text-gray-700">Availability</label>
                            <select name="availability" id="availability" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                <option value="" disabled selected>Select availability</option>
                                <option value="Available">Available</option>
                                <option value="OutofStock">Out of Stock</option>
                            </select>
                        </div>
                        <div class="flex justify-end mt-6">
                            <button type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 rounded-lg text-sm px-5 py-2.5 mr-2 focus:outline-none" data-modal-hide="createMaterialModal">Cancel</button>
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
                        Are you sure you want to delete <strong>this material</strong>? This action cannot be undone.
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

    <!-- Modal untuk Edit Material -->
    <div id="editMaterialModal" tabindex="-1" aria-hidden="true" class="fixed inset-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-[calc(100%-1rem)] max-h-full bg-gray-900 bg-opacity-50 backdrop-blur-sm">
        <div class="relative w-full max-w-2xl max-h-full mx-auto">
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Edit Material
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="editMaterialModal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <form id="editForm" method="POST" action="">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="edit_material_name" class="block text-sm font-medium text-gray-700">Material Name</label>
                            <input type="text" name="material_name" id="edit_material_name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div class="mb-4">
                            <label for="edit_brandname" class="block text-sm font-medium text-gray-700">Brand Name</label>
                            <input type="text" name="brandname" id="edit_brandname" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div class="mb-4">
                            <label for="edit_serial_number" class="block text-sm font-medium text-gray-700">Serial Number</label>
                            <input type="text" name="serial_number" id="edit_serial_number" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div class="mb-4">
                            <label for="edit_quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                            <input type="number" name="quantity" id="edit_quantity" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div class="mb-4">
                            <label for="edit_availability" class="block text-sm font-medium text-gray-700">Availability</label>
                            <select name="availability" id="edit_availability" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                <option value="Available">Available</option>
                                <option value="OutofStock">Out of Stock</option>
                            </select>
                        </div>
                        <div class="flex justify-end mt-6">
                            <button type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 rounded-lg text-sm px-5 py-2.5 mr-2 focus:outline-none" data-modal-hide="editMaterialModal">Cancel</button>
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg text-sm px-5 py-2.5 focus:outline-none">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @vite('resources/js/materials.js')
@endsection