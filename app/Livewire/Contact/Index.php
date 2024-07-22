<?php

namespace App\Livewire\Contact;

use Livewire\Component;
use Illuminate\Support\Facades\Mail;

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
        $this->validate();

        // Send email
        Mail::send([], [], function ($message) {
            $message->to('your-email@example.com')
                    ->subject('Contact Us Message')
                    ->setBody('Name: ' . $this->name . '<br>Email: ' . $this->email . '<br>Message: ' . $this->message, 'text/html');
        });

        session()->flash('success', 'Your message has been sent successfully.');

        // Clear form fields
        $this->reset();
    }
    public function render()
    {
        return view('livewire.contact.index');
    }
}
