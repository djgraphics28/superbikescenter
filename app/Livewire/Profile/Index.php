<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Livewire\Component;
use App\Models\Customer;
use App\Models\MonthlyDue;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{

    public $monthlyDues = [];
    public $profile;
    public function mount()
    {
        $customerId = Customer::where('user_id', Auth::user()->id)->first()->id;
        $this->profile = User::with('customer_details')->find(Auth::user()->id); // Replace with actual model and logic
        $this->monthlyDues = MonthlyDue::where('user_id', $customerId)->get();

        // dd($this->profile);
    }
    public function render()
    {
        return view('livewire.profile.index');
    }
}
