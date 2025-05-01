<?php

use App\Http\Controllers\Admin\CrewMemberController as AdminCrewMemberController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DestinationController as AdminDestinationController;
use App\Http\Controllers\Admin\TechnologyController as AdminTechnologyController;
use App\Http\Controllers\Api\CrewMemberController;
use App\Http\Controllers\Api\DestinationController;
use App\Http\Controllers\Api\TechnologyController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\WebAuthController;
use Illuminate\Support\Facades\Route;

// Health check route for Railway
Route::get('/health', function () {
    return response()->json(['status' => 'ok']);
});

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [WebAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [WebAuthController::class, 'login']);
    
    // Registration Routes
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::middleware('auth')->post('/logout', [WebAuthController::class, 'logout'])->name('logout');

// API Routes
Route::prefix('api')->group(function () {
    // Auth routes
    Route::post('/login', [AuthController::class, 'login']);
    Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
    
    // Destination routes
    Route::get('/destinations', [DestinationController::class, 'index']);
    Route::get('/destinations/{id}', [DestinationController::class, 'show']);
    
    // Crew routes
    Route::get('/crew', [CrewMemberController::class, 'index']);
    Route::get('/crew/{id}', [CrewMemberController::class, 'show']);
    
    // Technology routes
    Route::get('/technologies', [TechnologyController::class, 'index']);
    Route::get('/technologies/{id}', [TechnologyController::class, 'show']);
});

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Admin Destination routes
    Route::resource('destinations', AdminDestinationController::class);
    
    // Admin Crew routes
    Route::resource('crew', AdminCrewMemberController::class);
    
    // Admin Technology routes
    Route::resource('technologies', AdminTechnologyController::class);
});

// Main website route
Route::get('/', function () {
    return view('welcome');
});
