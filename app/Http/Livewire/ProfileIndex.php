<?php

namespace App\Http\Livewire;

use App\Models\Profile;
use Livewire\Component;
use Livewire\WithPagination;

class ProfileIndex extends Component
{
    use WithPagination;

    protected $listeners = ['runSearch'];

    public $search;


    public function runSearch($searchValue)
    {
        $this->search = $searchValue;   // but WAIT
    }

    public function render()
    {
        return view('livewire.profile-index', [
            'profiles' => Profile::paginate(10)
        ]);
    }
}
