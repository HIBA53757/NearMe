<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Place;


class PlaceController extends Controller
{
    public function index()
    {
        $places = Place::withCount('experiences')->latest()->paginate(15);
        return view('admin.places.index', compact('places'));
    }

public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'latitude' => 'required|numeric|between:-90,90',
        'longitude' => 'required|numeric|between:-180,180',
        'description' => 'nullable|string',
    ]);

    $place = Place::create($validated);

    if ($place) {
        return back()->with('success', "Location '{$place->name}' registered successfully.");
    }

    return back()->with('error', 'Failed to save the location.');
}
}
