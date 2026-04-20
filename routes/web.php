<?php

use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\Admin\PlaceController;
use App\Http\Controllers\SavedController; 
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminDashboardController; 
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'check_banned', 'can:access-user'])->group(function () {

    Route::get('/dashboard', [ExperienceController::class, 'index'])->name('dashboard');

    Route::get('/saved', [ExperienceController::class, 'saved'])->name('saved');
    Route::post('/experiences/{experience}/save', [SavedController::class, 'toggle'])->name('experiences.save');
    Route::get('/experiences/{experience}', [ExperienceController::class, 'show'])->name('experiences.show');
    Route::post('/experiences', [ExperienceController::class, 'store'])->name('experiences.store');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/settings', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/bio', [ProfileController::class, 'updateBio'])->name('profile.update-bio');
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.update-photo');

    Route::get('/mapcard', function () { return view('mapcard'); })->name('mapcard');
});


Route::middleware(['auth', 'check_banned', 'can:access-admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('places', PlaceController::class);

        Route::post('/users/{user}/ban', [AdminDashboardController::class, 'toggleBan'])->name('users.ban');
});

Route::get('/', function () {
    $featured = \App\Models\Experience::withCount(['likedByUsers', 'comments'])
                // Laravel converts likedByUsers to liked_by_users_count
                ->orderBy('liked_by_users_count', 'desc') 
                ->first();

    $trending = \App\Models\Experience::with('user', 'photos') // Good to eager load these
                ->latest()
                ->take(3)
                ->get();

    return view('welcome', compact('featured', 'trending'));
});

require __DIR__ . '/auth.php';