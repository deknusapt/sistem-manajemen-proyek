@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Add New Documentation</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('documentations.store') }}" enctype="multipart/form-data" class="bg-white shadow rounded-lg p-6">
            @csrf
            <input type="hidden" name="id_project" value="{{ $project->id_project }}">
            <div class="mb-4">
                <label for="doc_name" class="block text-sm font-medium text-gray-700">Documentation Name</label>
                <input type="text" name="doc_name" id="doc_name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-4 py-2" required>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="4" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-4 py-2" required></textarea>
            </div>
            <div class="mb-4">
                <label for="file_photos" class="block text-sm font-medium text-gray-700">Upload File</label>
                <input type="file" name="file_photos" id="file_photos" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-4 py-2" required>
            </div>
            <div class="mb-4">
                <label for="id_user" class="block text-sm font-medium text-gray-700">PIC (Person in Charge)</label>
                <select name="id_user" id="id_user" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-4 py-2" required>
                    @foreach ($users as $user)
                        <option value="{{ $user->id_user }}">{{ $user->fullname }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">
                Submit
            </button>
        </form>
    </div>
@endsection