<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Experience;
use Illuminate\Support\Facades\Auth;

class SaveExperience extends Component
{
    public $experience;
    public $isSaved;

    public function mount(Experience $experience)
    {
        $this->experience = $experience;
        
        if (Auth::check()) {
            /** @var \App\Models\User $user */
            $user = Auth::user();

            $this->isSaved = $user->savedExperiences()
                ->where('experience_id', $experience->id)
                ->exists();
        } else {
            $this->isSaved = false;
        }
    }

    public function toggleSave()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($this->isSaved) {
            $user->savedExperiences()->detach($this->experience->id);
            $this->isSaved = false;
        } else {
            $user->savedExperiences()->attach($this->experience->id);
            $this->isSaved = true;
        }
    }

    public function render()
    {
        return view('livewire.save-experience');
    }
}