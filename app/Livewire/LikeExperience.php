<?php namespace App\Livewire;

use Livewire\Component;
use App\Models\Experience;
use Illuminate\Support\Facades\Auth;

class LikeExperience extends Component
{
    public $experience;
    public $isLiked;
    public $likesCount;

    public function mount(Experience $experience)
    {
        $this->experience = $experience;
        $this->likesCount = $experience->likedByUsers()->count();
        $this->isLiked = Auth::check() ? Auth::user()->likedExperiences()->where('experience_id', $experience->id)->exists() : false;
    }

    public function toggleLike()
    {
        if (!Auth::check()) return redirect()->route('login');

        $user = Auth::user();
        if ($this->isLiked) {
            $user->likedExperiences()->detach($this->experience->id);
            $this->likesCount--;
            $this->isLiked = false;
        } else {
            $user->likedExperiences()->attach($this->experience->id);
            $this->likesCount++;
            $this->isLiked = true;
        }
    }

    public function render() { return view('livewire.like-experience'); }
}