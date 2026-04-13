<?php

use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {




    Route::get('/dashboard', [ExperienceController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    
    Route::patch('/profile/bio', [ProfileController::class, 'updateBio'])->name('profile.update-bio');

    Route::post('/experiences', [ExperienceController::class, 'store'])->name('experiences.store');













    // Dashboard = Experiences feed
    // Route::get('/dashboard', [ExperienceController::class, 'index'])->name('dashboard');

    // // Experiences
    // Route::resource('experiences', ExperienceController::class);

    // // Places
    // Route::resource('places', PlaceController::class)->only(['index', 'show']);

    // // Comments
    // Route::post('/experiences/{experience}/comments', [CommentController::class, 'store'])
    //     ->name('comments.store');

    // // Favorites
    // Route::post('/experiences/{experience}/favorite', [FavoriteController::class, 'store'])
    //     ->name('favorites.store');

    // Route::delete('/experiences/{experience}/favorite', [FavoriteController::class, 'destroy'])
    //     ->name('favorites.destroy');

    // Route::get('/favorites', [FavoriteController::class, 'index'])
    //     ->name('favorites.index');

    // // Profile
    // Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile');

});

require __DIR__ . '/auth.php';
