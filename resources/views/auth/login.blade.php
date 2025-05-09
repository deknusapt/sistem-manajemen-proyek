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
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <label for="email" class="block mb-1 text-sm font-medium">Email</label>
                <input type="email" name="email" class="w-full px-3 py-2 border rounded-md" placeholder="type your email" required>
            </div>
            <div>
                <label for="password" class="block mt-4 mb-1 text-sm font-medium">Password</label>
                <input type="password" name="password" class="w-full px-3 py-2 border rounded-md" placeholder="type your password" required>
            </div>
            <button type="submit" class="w-full mt-4 py-2 bg-blue-900 text-white rounded-md">Login</button>
        </form>
        <div class="text-center text-sm text-gray-500">
            <a href="{{ route('password.request') }}">Forget password?</a>
        </div>
    </div>
</div>
@endsection