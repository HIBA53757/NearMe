<?php

namespace App\Livewire;

use App\Models\Experience;
use Livewire\Component;
use Livewire\WithPagination;

class ExperienceFeed extends Component
{
    use WithPagination;

    public $search = '';
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $experiences = Experience::query()
            ->with(['user', 'photos', 'place'])
            ->where(function($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('content', 'like', '%' . $this->search . '%')
                      ->orWhereHas('place', function($q) {
                          $q->where('name', 'like', '%' . $this->search . '%');
                      });
            })
            ->latest()
            ->get(); 

        return view('livewire.experience-feed', [
            'experiences' => $experiences
        ]);
    }
}
