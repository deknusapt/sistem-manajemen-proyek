@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Reports</h1>

    <!-- Cards Summary -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <!-- Done Projects -->
        <div class="bg-green-100 p-4 rounded-lg flex items-center">
            <div class="flex-shrink-0">
                <svg class="h-8 w-8 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <div class="ml-4">
                <h2 class="text-lg font-bold text-green-700">{{ $doneProjects }} Done</h2>
                <p class="text-sm text-green-600">in the last 7 days</p>
            </div>
        </div>

        <!-- Created Projects -->
        <div class="bg-yellow-100 p-4 rounded-lg flex items-center">
            <div class="flex-shrink-0">
                <svg class="h-8 w-8 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </div>
            <div class="ml-4">
                <h2 class="text-lg font-bold text-yellow-700">{{ $createdProjects }} Created</h2>
                <p class="text-sm text-yellow-600">in the last 7 days</p>
            </div>
        </div>

        <!-- Updated Projects -->
        <div class="bg-purple-100 p-4 rounded-lg flex items-center">
            <div class="flex-shrink-0">
                <svg class="h-8 w-8 text-purple-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v16m8-8H4" />
                </svg>
            </div>
            <div class="ml-4">
                <h2 class="text-lg font-bold text-purple-700">{{ $updatedProjects }} Updated</h2>
                <p class="text-sm text-purple-600">in the last 7 days</p>
            </div>
        </div>

        <!-- Due Projects -->
        <div class="bg-blue-100 p-4 rounded-lg flex items-center">
            <div class="flex-shrink-0">
                <svg class="h-8 w-8 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v10m8-10v10m-8 4h8" />
                </svg>
            </div>
            <div class="ml-4">
                <h2 class="text-lg font-bold text-blue-700">{{ $dueProjects }} Overdue</h2>
                <p class="text-sm text-blue-600">projects past their deadlines</p>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Projects by Status -->
        <div class="w-full bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
            <div class="p-5">
                <h2 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Projects by Status</h2>

                <div class="flex justify-around items-end h-64">
                    @foreach ($projectsByStatus as $status)
                        @php
                            $height = $status->total * 20;
                            $colorClass = match(strtolower($status->status)) {
                                'completed' => 'bg-green-500',
                                'onprogress' => 'bg-blue-500',
                                'canceled' => 'bg-red-500',
                                'pending' => 'bg-yellow-400',
                                default => 'bg-gray-400',
                            };
                        @endphp
                        
                        <div class="flex flex-col items-center">
                            <span class="mb-2 text-sm font-semibold text-gray-800 dark:text-white">{{ $status->total }}</span>
                            <div class="{{ $colorClass }} w-12 rounded-t-md transition-all duration-500" style="height: {{ $height }}px;"></div>
                            <span class="mt-2 text-sm font-medium text-gray-700 dark:text-gray-300 capitalize">{{ $status->status }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>


        <!-- Materials Availability -->
        <div class="w-full bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
            <div class="p-5">
                <h2 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Materials Availability</h2>

                <div class="flex justify-center">
                    <div class="relative w-48 h-48">
                        <!-- Donut Chart -->
                        <div class="w-full h-full rounded-full"
                             style="background: conic-gradient(#ef4444 {{ $materialsAvailability['available'] }}%, #3b82f6 0);">
                        </div>

                        <!-- Inner white circle -->
                        <div class="absolute inset-4 bg-white dark:bg-gray-800 rounded-full flex items-center justify-center">
                            <div class="text-center">
                                <div class="text-sm text-gray-500 dark:text-gray-400">Stock Availability</div>
                                <div class="text-xl font-bold text-gray-900 dark:text-white">
                                    {{ $materialsAvailability['available'] }}%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Legend -->
                <div class="mt-6 flex justify-center space-x-6">
                    <div class="flex items-center space-x-2">
                        <span class="w-4 h-4 bg-blue-500 rounded-full"></span>
                        <span class="text-sm text-gray-700 dark:text-gray-300">Available</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="w-4 h-4 bg-red-500 rounded-full"></span>
                        <span class="text-sm text-gray-700 dark:text-gray-300">Out of Stock</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection