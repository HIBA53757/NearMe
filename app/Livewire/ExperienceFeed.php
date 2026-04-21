<?php

namespace App\Livewire;

use App\Models\Experience;
use Livewire\Component;
use Livewire\WithPagination;

class ExperienceFeed extends Component
{
    use WithPagination;

    public $search = '';
    public $rating = '';
    public $time_of_day = '';
    public $ambiance = '';
    public $activity_type = '';
    public $crowd_level = '';

    public function updated($propertyName)
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Experience::query()
            ->with(['user', 'photos', 'place'])
          
            ->where(fn($q) => 
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('content', 'like', '%' . $this->search . '%')
            )
         
            ->when($this->rating, fn($q) => $q->where('rating', '>=', $this->rating))
            ->when($this->time_of_day, fn($q) => $q->where('time_of_day', $this->time_of_day))
            ->when($this->ambiance, fn($q) => $q->where('ambiance', $this->ambiance))
            ->when($this->activity_type, fn($q) => $q->where('activity_type', $this->activity_type))
            ->when($this->crowd_level, fn($q) => $q->where('crowd_level', $this->crowd_level));

        return view('livewire.experience-feed', [
            'experiences' => $query->latest()->get()
        ]);
    }
}