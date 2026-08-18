<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\Admin\ProjectRequestController as AdminProjectRequestController;
use App\Http\Controllers\ProjectRequestController;
use App\Http\Controllers\TeamMemberController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return \Illuminate\Support\Facades\Hash::make('Farhan1@');
})->name('home');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Admin Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('portfolios', PortfolioController::class);
    Route::post('/portfolios/{portfolio}/toggle-publish', [PortfolioController::class, 'togglePublish'])->name('portfolios.toggle-publish');
    Route::resource('team', TeamMemberController::class);
});

Route::post('/project-requests', [ProjectRequestController::class, 'store'])
    ->name('project-requests.store')
    ->middleware('throttle:5,1');
Route::get('/', function () {
    return view('index');
})->name('home');
Route::get('/', function () {
    return view('index');
})->name('home');
Route::get('project-requests', [AdminProjectRequestController::class, 'index'])->name('project-requests.index');
Route::get('project-requests/{projectRequest}', [AdminProjectRequestController::class, 'show'])->name('project-requests.show');
Route::patch('project-requests/{projectRequest}/toggle-read', [AdminProjectRequestController::class, 'toggleRead'])->name('project-requests.toggle-read');
Route::delete('project-requests/{projectRequest}', [AdminProjectRequestController::class, 'destroy'])->name('project-requests.destroy');
