<?php

use App\Http\Controllers\Admin\AboutSectionController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\HeroSectionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\Admin\ProjectRequestController as AdminProjectRequestController;
use App\Http\Controllers\ProjectRequestController;
use App\Http\Controllers\TeamMemberController;
use Illuminate\Support\Facades\Route;



// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Admin Routes
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('portfolios', PortfolioController::class);
    Route::post('/portfolios/{portfolio}/toggle-publish', [PortfolioController::class, 'togglePublish'])->name('portfolios.toggle-publish');
    Route::resource('team', TeamMemberController::class);

    // Service Management
    Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class)->only(['index', 'create', 'store', 'destroy']);

    // Achievement Management
    Route::resource('achievements', \App\Http\Controllers\Admin\AchievementController::class)->only(['index', 'create', 'store', 'destroy']);

    // Technology Management
    Route::resource('technologies', \App\Http\Controllers\Admin\TechnologyController::class)->only(['index', 'create', 'store', 'destroy']);

    Route::post('/project-requests', [ProjectRequestController::class, 'store'])
        ->name('project-requests.store')
        ->middleware('throttle:5,1');

    Route::get('project-requests', [AdminProjectRequestController::class, 'index'])->name('project-requests.index');
    Route::get('project-requests/{projectRequest}', [AdminProjectRequestController::class, 'show'])->name('project-requests.show');
    Route::patch('project-requests/{projectRequest}/toggle-read', [AdminProjectRequestController::class, 'toggleRead'])->name('project-requests.toggle-read');
    Route::delete('project-requests/{projectRequest}', [AdminProjectRequestController::class, 'destroy'])->name('project-requests.destroy');
    // Hero Section Management
    Route::get('/hero-section', [App\Http\Controllers\Admin\HeroSectionController::class, 'edit'])->name('admin.hero-section.edit');
    Route::put('/hero-section', [App\Http\Controllers\Admin\HeroSectionController::class, 'update'])->name('admin.hero-section.update');

    // Site Settings Management
    Route::get('/site-settings', [App\Http\Controllers\Admin\SiteSettingController::class, 'edit'])->name('admin.site-settings.edit');
    Route::put('/site-settings', [App\Http\Controllers\Admin\SiteSettingController::class, 'update'])->name('admin.site-settings.update');

    Route::get('/about-sction', [AboutSectionController::class, 'edit'])->name('admin.about-section.edit');
    Route::put('/about-sction/update', [AboutSectionController::class, 'update'])->name('admin.about-section.update');

    Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
});
Route::get('/', [IndexController::class, 'index'])->name('home');
