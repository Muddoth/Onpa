<?php

namespace App\Http\Livewire;

use App\Models\Profile;
use Livewire\Component;

class ProfileShow extends Component
{
    public $profile;

    protected $listeners = ['show-profile' => 'loadProfile'];

    public function loadProfile($data)
    {
        $this->profile = Profile::find($data['id']);
    }

    public function render()
    {
        return view('livewire.profile-show');
    }
}
