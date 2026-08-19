<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\Admin\ProjectRequestController as AdminProjectRequestController;
use App\Http\Controllers\ProjectRequestController;
use App\Http\Controllers\TeamMemberController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LocaleController;

Route::get('/blog', [PostController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [PostController::class, 'show'])->name('blog.show');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');


Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


Route::resource('posts', AdminPostController::class )->except(['show']);

Route::patch('posts/{post}/toggle-status', [AdminPostController::class, 'toggleStatus'])
    ->name('posts.toggle-status');

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

Route::get('/portfolio', [PortfolioController::class, 'publicIndex'])->name('portfolio.list');
Route::get('/portfolio/{portfolio:slug}', [PortfolioController::class, 'show'])->name('portfolio.show');

Route::get('/team/{team:slug}', [TeamMemberController::class, 'show'])->name('team.show');
Route::resource('posts', AdminPostController::class)->except(['show']);
Route::patch('posts/{post}/toggle-status', [AdminPostController::class, 'toggleStatus'])->name('posts.toggle-status');
Route::post('posts/upload-content-image', [AdminPostController::class, 'uploadContentImage'])->name('posts.upload-content-image');
Route::get('/lang/{locale}', [LocaleController::class, 'switch'])->name('lang.switch');

Route::get('/blog', [PostController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [PostController::class, 'show'])->name('blog.show');
