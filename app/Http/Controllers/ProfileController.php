<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }


  public function show()
{
    /** @var \App\Models\User $user */
    $user = auth()->user();
    
    $myExperiences = $user->experiences()->with(['photos', 'place'])->latest()->get();
    $places = \App\Models\Place::all();

   
    $likesCount = $user->experiences()
        ->withCount('likedByUsers') 
        ->get()
        ->sum('liked_by_users_count');

    return view('profile', compact('user', 'myExperiences', 'places', 'likesCount'));
}

public function updateBio(Request $request)
{
    $request->validate(['bio' => 'nullable|string|max:500']);
    
    auth()->user()->update(['bio' => $request->bio]);

    return back()->with('success', 'Bio updated!');
}

public function updatePhoto(Request $request)
{
    $request->validate([
        'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $user = auth()->user();

    if ($request->hasFile('photo')) {
        $path = $request->file('photo')->store('profile_photos', 'public');
        $user->update([
            'profile_photo' => $path
        ]);
    }

    return back()->with('success', 'Profile photo updated!');
}
}
