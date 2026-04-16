<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class savedController extends Controller
{
   public function toggle(Experience $experience)
    {
        $user = Auth::user();
        
        // Check if this experience is already saved by this user
        // Note: Using your 'Saved' model
        $saved = \App\Models\Saved::where('user_id', $user->id)
                                 ->where('experience_id', $experience->id)
                                 ->first();

        if ($saved) {
            $saved->delete();
            $isSaved = false;
        } else {
            \App\Models\Saved::create([
                'user_id' => $user->id,
                'experience_id' => $experience->id
            ]);
            $isSaved = true;
        }

        return response()->json([
            'isSaved' => $isSaved
        ]);
    }
}
