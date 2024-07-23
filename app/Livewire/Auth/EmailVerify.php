<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class EmailVerify extends Component
{
    public function resendVerification()
    {
        if (Auth::user()->hasVerifiedEmail()) {
            return redirect()->route('home');
        }

        Auth::user()->sendEmailVerificationNotification();

        session()->flash('message', 'Verification link sent!');
    }
    public function render()
    {
        return view('livewire.auth.email-verify');
    }
}
