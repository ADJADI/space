@extends('layouts.auth')

@section('title', 'Space Admin - Register')
@section('subtitle', 'Create a new admin account')

@section('content')
    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf
        <div>
            <label for="name" class="block text-sm font-medium text-gray-300">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                   class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>
        
        <div>
            <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                   class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>
        
        <div>
            <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
            <input type="password" id="password" name="password" required
                   class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>
        
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-300">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required
                   class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>
        
        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Register
        </button>
    </form>
    
    <div class="mt-6 text-center">
        <p class="text-sm text-gray-400">
            Already have an account? <a href="{{ route('login') }}" class="text-blue-400 hover:text-blue-300">Login</a>
        </p>
    </div>
@endsection 