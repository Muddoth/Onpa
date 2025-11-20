<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\Profile;

class ProfileSearch extends Component
{
    #[Validate('required')]
    public $search = '';

    public $profiles = [];

    public function updatedSearch($value)
    {
        // dd($value); // instantly shows what Livewire received

        // Reset profiles when search changes
        $this->reset('profiles');

        // stop searching if nothing typed
        if (strlen($value) < 1) {
            // dd($value); // instantly shows what Livewire received
            return;
        }

        $searchTerm = "%$value%";

        $this->profiles = Profile::where('name', 'LIKE', $searchTerm)
            ->orWhere('bio', 'LIKE', $searchTerm)
            ->orderBy('name')
            ->get();
    }

    public function clearSearch()
    {
        $this->reset('search', 'profiles');
    }

    public function render()
    {
        return view('livewire.profile-search');
    }
}
