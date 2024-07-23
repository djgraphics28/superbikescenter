<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{

    public $profile;
    public function mount()
    {

        $this->profile = User::with('customer_details')->find(Auth::user()->id); // Replace with actual model and logic

        // dd($this->profile);
    }
    public function render()
    {
        return view('livewire.profile.index');
    }
}
