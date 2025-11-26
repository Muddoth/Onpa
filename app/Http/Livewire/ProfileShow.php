<?php

namespace App\Http\Livewire;

use App\Models\Profile;
use Livewire\Component;

class ProfileShow extends Component
{
    #[Reactive]
    public Profile $profile;

    public function render()
    {
        return view('livewire.profile-show');
    }
}
