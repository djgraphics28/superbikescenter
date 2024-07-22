<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'sufix_name' => 'nullable|string|max:255',
            // 'username' => 'required|string|max:255|unique:customers,username',
            'email' => 'required|string|email|max:255|unique:customers,email',
            'password' => 'required|string|min:8',
            'contact_number' => 'required|string|max:20',
            'birth_date' => 'required|date',
            'gender' => 'required|in:Male,Female',
            'marital_status' => 'required|in:Single,Married,Widowed',
            'province_id' => 'required|string',
            'city_id' => 'required|string',
            'barangay_id' => 'required|string',
            'address1' => 'required|string',
            'address2' => 'nullable|string',
        ];
    }
}
