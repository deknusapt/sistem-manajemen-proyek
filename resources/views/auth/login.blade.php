@extends('layouts.loginpage')
@section('content')
<div class="flex justify-center items-center h-screen">
    <div class="w-full max-w-md p-8 space-y-4 bg-white rounded-lg shadow">
        <div class="text-center">
            <img src="../magnum-text.png" alt="Logo" class="h-16 mx-auto mb-4">
            <h1 class="text-2xl font-bold">Project Management System</h1>
            <br>
            <p class="text-gray-500">Please login with your credential to enter the project dashboard</p>
        </div>
        <!-- Tampilkan pesan error umum -->
        @if ($errors->any())
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <label for="email" class="block mb-1 text-sm font-medium">Email</label>
                <input type="email" name="email" id="email" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="type your email" required>
            </div>
            <div>
                <label for="password" class="block mt-4 mb-1 text-sm font-medium">Password</label>
                <input type="password" name="password" id="password" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="type your password" required>
            </div>
            <button type="submit" class="w-full mt-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">Login</button>
        </form>
        <div class="text-center text-sm text-gray-500">
            <a href="{{ route('password.request') }}" class="text-blue-600 hover:underline">Forget password?</a>
        </div>
    </div>
</div>
@endsection