<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CustomerRegisterRequest;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed, return success response
            return response()->json(['message' => 'Login successful'], 200);
        } else {
            // Authentication failed, return error response
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }

    public function register(CustomerRegisterRequest $request)
    {
        $data = $request->validated();
        // $data['password'] = Hash::make($data['password']);

        $user = User::create([
            'name' => $data['first_name'] . ' ' . $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $customer = Customer::create([
            'user_id' => $user->id,
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'],
            'last_name' => $data['last_name'],
            'sufix_name' => $data['sufix_name'],
            'contact_number' => $data['contact_number'],
            'birth_date' => $data['birth_date'],
            'gender' => $data['gender'],
            'marital_status' => $data['marital_status'],
            'province_id' => $data['province_id'],
            'city_id' => $data['city_id'],
            'barangay_id' => $data['barangay_id'],
            'address1' => $data['address1'],
            'address2' => $data['address2'],
        ]);

        return response()->json([
            'message' => 'Customer registered successfully',
            'customer' => $customer
        ], 201);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out']);
    }
}
