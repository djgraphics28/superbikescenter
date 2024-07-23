<?php

namespace App\Livewire\Contact;

use Livewire\Component;
use App\Mail\ContactUsEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUsAutoResponderEmail;

class Index extends Component
{
    public $name;
    public $email;
    public $message;

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'message' => 'required|min:10',
    ];

    public function submit()
    {
        $validated = $this->validate([
            'email' => 'required|email',
            'name' => 'required',
            'message' => 'required',
        ]);

        // Send email
        Mail::to('no-reply@superbikescentral.online')->send(new ContactUsEmail($validated));

        Mail::to($validated['email'])->send(new ContactUsAutoResponderEmail($validated));

        sleep(3);

        session()->flash('success', 'Your message has been sent successfully.');

        // Clear form fields
        $this->reset();
    }
    public function render()
    {
        return view('livewire.contact.index');
    }

    public function mount()
    {
        $this->name = Auth::user()->name ?? '';
        $this->email = Auth::user()->email ?? '';
    }
}
