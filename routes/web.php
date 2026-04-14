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
    Route::get('/profile/settings', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile/bio', [ProfileController::class, 'updateBio'])->name('profile.update-bio');

    Route::post('/experiences', [ExperienceController::class, 'store'])->name('experiences.store');

    Route::get('/experiences/{experience}', [ExperienceController::class, 'show'])
    ->name('experiences.show');

    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.update-photo');













   

});

require __DIR__ . '/auth.php';
