@extends('layouts.loginpage')

@section('content')
<div class="flex justify-center items-center h-screen">
    <div class="w-full max-w-md p-8 space-y-4 bg-white rounded-lg shadow">
        <div class="text-center">
            <h1 class="text-2xl font-bold">Forgot Password</h1>
            <p class="text-gray-500">Enter your email to receive a password reset link.</p>
        </div>
        @if (session('status'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div>
                <label for="email" class="block mb-1 text-sm font-medium">Email</label>
                <input type="email" name="email" id="email" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Enter your email" required>
            </div>
            <button type="submit" class="w-full mt-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">Send Reset Link</button>
        </form>
    </div>
</div>
@endsection