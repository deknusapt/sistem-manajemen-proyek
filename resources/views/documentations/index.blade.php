@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Documentations for {{ $project->project_name }}</h1>

        <!-- Documentation List -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Documentation Lists</h3>
            <a href="{{ route('documentations.create', $project->id_project) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-4 focus:outline-none">
                New Documentation
            </a>

            @if ($documentations->isEmpty())
                <p class="mt-4">No documentations available for this project.</p>
            @else
                <ul class="divide-y divide-gray-200">
                    @foreach ($documentations as $documentation)
                        <li class="py-4">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h4 class="text-lg font-semibold">
                                        <a href="{{ route('documentations.show', $documentation->id_doc) }}" class="text-blue-600 hover:underline">
                                            {{ $documentation->doc_name }}
                                        </a>
                                    </h4>
                                    <p class="text-sm text-gray-600">
                                        {{ Str::limit($documentation->description, 100, '...') }}
                                        <a href="{{ route('documentations.show', $documentation->id_doc) }}" class="text-blue-600 hover:underline">Read More</a>
                                    </p>
                                    <p class="text-xs text-gray-500">Submitted by: {{ $documentation->user->name }} on {{ $documentation->date_submitted }}</p>
                                </div>
                                <div class="flex gap-2">
                                    <a href="{{ route('documentations.edit', $documentation->id_doc) }}" class="text-blue-600 hover:underline">Edit</a>
                                    <form method="POST" action="{{ route('documentations.destroy', $documentation->id_doc) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection