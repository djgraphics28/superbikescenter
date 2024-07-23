<?php

namespace App\Livewire\Application;

use App\Models\Product;
use Livewire\Component;

class Index extends Component
{
    public $name;
    public $email;
    public $phone;
    public $product;
    public $products = [];
    public $loan_amount;
    public $terms;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|numeric',
        'product' => 'required|string|max:255',
        // 'loan_amount' => 'required|numeric|min:1000',
        'terms' => 'accepted',
    ];

    public function submit()
    {
        $this->validate();

        // Handle form submission logic, such as saving data to the database

        session()->flash('message', 'Application submitted successfully.');
        $this->reset(); // Clear form fields
    }

    public function render()
    {
        return view('livewire.application.index');
    }

    public function mount()
    {
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;

        $this->products = Product::all();
    }

    /**
     * Reset cities and barangays when province changes.
     */
    public function updatedProduct($value)
    {
        $motor = Product::find($value);

        $this->loan_amount = $motor->price;
    }
}
