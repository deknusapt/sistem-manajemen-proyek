@extends('layouts.loginpage')

@section('content')
<div class="flex justify-center items-center h-screen">
    <div class="w-full max-w-md p-8 space-y-4 bg-white rounded-lg shadow">
        <div class="text-center">
            <h1 class="text-2xl font-bold">Reset Password</h1>
            <p class="text-gray-500">Enter your new password below.</p>
        </div>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div>
                <label for="email" class="block mb-1 text-sm font-medium">Email</label>
                <input type="email" name="email" id="email" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" value="{{ old('email') }}" required>
            </div>
            <div>
                <label for="password" class="block mt-4 mb-1 text-sm font-medium">New Password</label>
                <input type="password" name="password" id="password" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
            </div>
            <div>
                <label for="password_confirmation" class="block mt-4 mb-1 text-sm font-medium">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
            </div>
            <button type="submit" class="w-full mt-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">Reset Password</button>
        </form>
    </div>
</div>
@endsection