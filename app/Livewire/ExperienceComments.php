<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;
use App\Models\Experience;
use Illuminate\Support\Facades\Auth;

class ExperienceComments extends Component
{
    public $experience;
    public $newComment = '';

    protected $rules = [
        'newComment' => 'required|min:3|max:500',
    ];

    public function mount(Experience $experience)
    {
        $this->experience = $experience;
    }

    public function postComment()
    {
        if (!Auth::check()) return redirect()->route('login');

        $this->validate();

        Comment::create([
            'user_id' => Auth::id(),
            'experience_id' => $this->experience->id,
            'content' => $this->newComment,
        ]);

        $this->newComment = ''; 
        $this->experience->load('comments'); // Refresh list
    }

    public function render()
    {
        return view('livewire.experience-comments', [
            'comments' => $this->experience->comments
        ]);
    }
}
