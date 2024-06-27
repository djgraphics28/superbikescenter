<?php

namespace App\Livewire\Customer;

use Livewire\Component;
use Yajra\Address\Entities\City;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Yajra\Address\Entities\Barangay;
use Yajra\Address\Entities\Province;
use App\Mail\RegistrationSuccessResponse;
use App\Models\Customer; // Assuming your model is named Customer

class Register extends Component
{
    public $first_name;
    public $middle_name;
    public $last_name;
    public $sufix_name;
    public $username;
    public $email;
    public $password;
    public $contact_number;
    public $birth_date;
    public $gender;
    public $marital_status;
    public $province_id;
    public $city_id;
    public $barangay_id;
    public $address1;
    public $address2;

    protected $rules = [
        'first_name' => 'required|string',
        'middle_name' => 'nullable|string',
        'last_name' => 'required|string',
        'sufix_name' => 'nullable|string',
        'username' => 'required|string|unique:customers,username',
        'email' => 'required|email|unique:customers,email',
        'password' => 'required|string|min:6',
        'contact_number' => 'required|string',
        'birth_date' => 'required|date',
        'gender' => 'required|in:Male,Female',
        'marital_status' => 'required|in:Single,Married,Widowed',
        'province_id' => 'required|string',
        'city_id' => 'required|string',
        'barangay_id' => 'required|string',
        'address1' => 'required|string',
        'address2' => 'nullable|string',
    ];

    public function render()
    {
        // Fetch provinces, cities, and barangays
        $provinces = Province::all();
        $cities = [];
        $barangays = [];

        if (!is_null($this->province_id)) {
            $cities = City::where('province_id', $this->province_id)->get();
        }

        if (!is_null($this->city_id)) {
            $barangays = Barangay::where('city_id', $this->city_id)->get();
        }

        return view('livewire.customer.register', [
            'provinces' => $provinces,
            'cities' => $cities,
            'barangays' => $barangays,
        ]);
    }

    /**
     * Reset cities and barangays when province changes.
     */
    public function updatedProvince($value)
    {
        $this->city_id = null;
        $this->barangay_id = null;

        if (!is_null($value)) {
            $this->cities = City::where('province_id', $value)->get();
        } else {
            $this->cities = [];
        }
    }

    /**
     * Reset barangays when city changes.
     */
    public function updatedCity($value)
    {
        $this->barangay_id = null;

        if (!is_null($value)) {
            $this->barangays = Barangay::where('city_id', $value)->get();
        } else {
            $this->barangays = [];
        }
    }

    public function submit()
    {
        // Validate the input data
        $validatedData = $this->validate();

        $unhashedPass = $validatedData['password'];
        // Hash the password before saving
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Create new customer record
        $create = Customer::create($validatedData);

        $validatedData['unhashedPass'] = $unhashedPass;

        if($create) {
            Mail::to($this->email)->send(new RegistrationSuccessResponse($validatedData));
        }

        // Optionally, you can add a success message
        session()->flash('message', 'Customer registered successfully.');

        // Clear form fields after submission
        $this->reset();

        // Redirect to the home route using Livewire's redirect
        return redirect()->route('home')->with('message', 'Customer registered successfully.');
    }
}
