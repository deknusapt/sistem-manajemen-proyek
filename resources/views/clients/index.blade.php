@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Clients</h1>

        <div class="mb-4">
            <a href="{{ route('clients.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none">
                New Client
            </a>
        </div>

        <div class="relative overflow-x-auto sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center">Full Name</th>
                        <th scope="col" class="px-6 py-3 text-center">Company</th>
                        <th scope="col" class="px-6 py-3 text-center">Position</th>
                        <th scope="col" class="px-6 py-3 text-center">Address</th>
                        <th scope="col" class="px-6 py-3 text-center">Phone Number</th>
                        <th scope="col" class="px-6 py-3 text-center">Email</th>
                        <th scope="col" class="px-6 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $client)
                        <tr class="bg-white border-b">
                            <td class="px-6 py-4 text-center">{{ $client->client_fullname }}</td>
                            <td class="px-6 py-4 text-center">{{ $client->company }}</td>
                            <td class="px-6 py-4 text-center">{{ $client->position }}</td>
                            <td class="px-6 py-4 text-center">{{ $client->address }}</td>
                            <td class="px-6 py-4 text-center">{{ $client->phone_number }}</td>
                            <td class="px-6 py-4 text-center">{{ $client->email }}</td>
                            <td class="px-6 py-4 flex gap-2 justify-center">
                                <a href="{{ route('clients.edit', $client->id_client) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none">
                                    Edit
                                </a>
                                <form action="{{ route('clients.destroy', $client->id_client) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $clients->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection