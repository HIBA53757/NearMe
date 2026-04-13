<?php
namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Photo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ExperienceController extends Controller
{
   public function index()
{
    
    $allExperiences = Experience::with(['user', 'photos', 'place'])->latest()->get();

    return view('dashboard', ['experiences' => $allExperiences]);
}

public function store(Request $request)
{
    
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'place_id' => 'required|exists:places,id',
        'rating' => 'nullable|integer|min:1|max:5',
        'photos.*' => 'image|mimes:jpeg,png,jpg|max:2048' // Max 2MB per photo
    ]);

    DB::transaction(function () use ($request) {
        $experience = Experience::create([
            'title' => $request->title,
            'content' => $request->content,
            'rating' => $request->rating,
            'place_id' => $request->place_id,
            'user_id' => auth()->id(),
        ]);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('experiences', 'public');
                
                Photo::create([
                    'path' => $path,
                    'experience_id' => $experience->id,
                ]);
            }
        }
    });

    return redirect()->route('profile')->with('status', 'Experience shared successfully!');
}

}