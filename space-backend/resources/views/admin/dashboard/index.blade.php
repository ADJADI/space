@extends('admin.layouts.app')

@section('title', 'Dashboard - Space Admin')

@section('header', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h5 class="text-lg font-medium text-gray-700">Destinations</h5>
                        <h2 class="text-3xl font-bold">{{ $statistics['destinations'] }}</h2>
                    </div>
                    <div class="bg-blue-500 rounded-full flex items-center justify-center w-14 h-14">
                        <i class="bi bi-globe text-white text-2xl"></i>
                    </div>
                </div>
                <a href="{{ route('admin.destinations.index') }}" class="mt-4 inline-block px-4 py-2 border border-blue-500 text-blue-500 rounded text-sm hover:bg-blue-500 hover:text-white transition-colors">View All</a>
            </div>
        </div>
        
        <div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h5 class="text-lg font-medium text-gray-700">Crew Members</h5>
                        <h2 class="text-3xl font-bold">{{ $statistics['crew_members'] }}</h2>
                    </div>
                    <div class="bg-green-500 rounded-full flex items-center justify-center w-14 h-14">
                        <i class="bi bi-people text-white text-2xl"></i>
                    </div>
                </div>
                <a href="{{ route('admin.crew.index') }}" class="mt-4 inline-block px-4 py-2 border border-green-500 text-green-500 rounded text-sm hover:bg-green-500 hover:text-white transition-colors">View All</a>
            </div>
        </div>
        
        <div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h5 class="text-lg font-medium text-gray-700">Technologies</h5>
                        <h2 class="text-3xl font-bold">{{ $statistics['technologies'] }}</h2>
                    </div>
                    <div class="bg-cyan-500 rounded-full flex items-center justify-center w-14 h-14">
                        <i class="bi bi-gear text-white text-2xl"></i>
                    </div>
                </div>
                <a href="{{ route('admin.technologies.index') }}" class="mt-4 inline-block px-4 py-2 border border-cyan-500 text-cyan-500 rounded text-sm hover:bg-cyan-500 hover:text-white transition-colors">View All</a>
            </div>
        </div>
    </div>
    
    <div class="mt-8">
        <div class="bg-white rounded-lg shadow">
            <div class="border-b px-6 py-4">
                <h5 class="font-medium">Welcome to Space Admin</h5>
            </div>
            <div class="p-6">
                <p class="mb-4">This is the admin panel for your space travel website. Here you can manage the content displayed on your site.</p>
                <p class="mb-2">Use the sidebar to navigate to different sections:</p>
                <ul class="list-disc pl-6 space-y-1">
                    <li><span class="font-semibold">Destinations:</span> Manage the celestial bodies your customers can visit</li>
                    <li><span class="font-semibold">Crew Members:</span> Manage the profiles of your space travel crew</li>
                    <li><span class="font-semibold">Technologies:</span> Manage the technology information displayed on your website</li>
                </ul>
            </div>
        </div>
    </div>
@endsection 