@extends('layouts.auth')

@section('title', 'Space Admin - Login')
@section('subtitle', 'Enter your credentials to access the admin panel')

@section('content')
    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf
        <div>
            <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                   class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>
        
        <div>
            <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
            <input type="password" id="password" name="password" required
                   class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>
        
        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Log In
        </button>
    </form>
    
    <div class="mt-6 text-center">
        <p class="text-sm text-gray-400">
            Don't have an account? <a href="{{ route('register') }}" class="text-blue-400 hover:text-blue-300">Register</a>
        </p>
    </div>
@endsection 