<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use App\Models\Customer;
use Livewire\Attributes\Title;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\Address\Entities\Province;
use Yajra\Address\Entities\City;
use Yajra\Address\Entities\Barangay;

class Register extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $sufix_name;
    public $contact_number;
    public $birth_date;
    public $gender;
    public $marital_status;
    public $province_id;
    public $city_id;
    public $barangay_id;
    public $address1;
    public $address2;

    public $provinces = [];
    public $cities = [];
    public $barangays = [];

    public function register()
    {
        $validated = $this->validate([
            'first_name' => 'required',
            'middle_name' => 'nullable',
            'last_name' => 'required',
            'sufix_name' => 'nullable',
            'contact_number' => 'required',
            'birth_date' => 'required|date',
            'gender' => 'required',
            'marital_status' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
            'barangay_id' => 'required',
            'address1' => 'required',
            'address2' => 'nullable',
            'email' => [
                'required',
                'email',
                Rule::unique('users')
            ],
            'password' => [
                'required',
                'confirmed'
            ],
        ]);

        $user = User::create([
            'name' => $validated['first_name'] . ' ' . $validated['last_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Customer::create([
            'user_id' => $user->id,
            'first_name' => $validated['first_name'],
            'middle_name' => $validated['middle_name'],
            'last_name' => $validated['last_name'],
            'sufix_name' => $validated['sufix_name'],
            'contact_number' => $validated['contact_number'],
            'birth_date' => $validated['birth_date'],
            'gender' => $validated['gender'],
            'marital_status' => $validated['marital_status'],
            'province_id' => $validated['province_id'],
            'city_id' => $validated['city_id'],
            'barangay_id' => $validated['barangay_id'],
            'address1' => $validated['address1'],
            'address2' => $validated['address2'],
        ]);

        Auth::login($user);

        session()->flash('success', 'Registration successful. Welcome!');

        return redirect()->route('home');
    }

    public function mount()
    {
        $this->provinces = Province::all();
    }

    public function updatedProvinceId($value)
    {
        $this->cities = City::where('province_id', $value)->get();
        $this->barangays = [];
    }

    public function updatedCityId($value)
    {
        $this->barangays = Barangay::where('city_id', $value)->get();
    }

    #[Title('Register')]
    public function render()
    {
        return view('livewire.auth.register');
    }
}
