<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Place;
use App\Models\Experience;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_places' => Place::count(),
            'total_experiences' => Experience::count(),
            'banned_users' => User::whereNotNull('banned_at')->count(),
            // Growth this month
            'new_this_month' => User::where('created_at', '>=', now()->startOfMonth())->count(),
        ];

        $recentUsers = User::latest()->take(10)->get();

        return view('admin.dashboard', compact('stats', 'recentUsers'));
    }

    public function toggleBan(User $user)
    {
        // Prevent admins from banning themselves
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot ban yourself.');
        }

        $user->banned_at = $user->banned_at ? null : now();
        $user->save();

        $status = $user->banned_at ? 'banned' : 'unbanned';
        return back()->with('success', "User has been {$status} successfully.");
    }
}