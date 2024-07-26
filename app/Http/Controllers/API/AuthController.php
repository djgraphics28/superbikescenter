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
    /**
     * @group Authentication
     *
     * Login a user
     *
     * This endpoint allows a user to log in using their email and password.
     *
     * @bodyParam email string required The email of the user. Example: user@example.com
     * @bodyParam password string required The password of the user. Example: password123
     *
     * @response 200 {
     *   "message": "Login successful",
     *   "token": "Bearer your_access_token_here"
     * }
     * @response 401 {
     *   "message": "Invalid credentials"
     * }
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json(['message' => 'Login successful', 'token' => $token], 200);
        } else {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }

    /**
     * @group Authentication
     *
     * Register a new user
     *
     * This endpoint registers a new user and their customer details.
     *
     * @bodyParam first_name string required The first name of the user. Example: John
     * @bodyParam middle_name string The middle name of the user. Example: M
     * @bodyParam last_name string required The last name of the user. Example: Doe
     * @bodyParam sufix_name string The suffix of the user. Example: Jr
     * @bodyParam email string required The email of the user. Example: user@example.com
     * @bodyParam password string required The password of the user. Example: password123
     * @bodyParam password_confirmation string required The confirmation of the password. Example: password123
     * @bodyParam contact_number string required The contact number of the user. Example: 09171234567
     * @bodyParam birth_date date required The birth date of the user. Example: 1990-01-01
     * @bodyParam gender string required The gender of the user. Example: Male
     * @bodyParam marital_status string required The marital status of the user. Example: Single
     * @bodyParam province_id int required The ID of the province. Example: 1
     * @bodyParam city_id int required The ID of the city. Example: 1
     * @bodyParam barangay_id int required The ID of the barangay. Example: 1
     * @bodyParam address1 string required The first address line. Example: 123 Main St
     * @bodyParam address2 string The second address line. Example: Apt 4B
     *
     * @response 201 {
     *   "message": "Successfully registered!",
     *   "customer": {
     *     "id": 1,
     *     "user_id": 1,
     *     "first_name": "John",
     *     "middle_name": "M",
     *     "last_name": "Doe",
     *     "sufix_name": "Jr",
     *     "contact_number": "09171234567",
     *     "birth_date": "1990-01-01",
     *     "gender": "Male",
     *     "marital_status": "Single",
     *     "province_id": 1,
     *     "city_id": 1,
     *     "barangay_id": 1,
     *     "address1": "123 Main St",
     *     "address2": "Apt 4B",
     *     "created_at": "2024-07-26T00:00:00.000000Z",
     *     "updated_at": "2024-07-26T00:00:00.000000Z"
     *   }
     * }
     * @response 422 {
     *   "errors": {
     *     "email": ["The email has already been taken."],
     *     "password": ["The password confirmation does not match."]
     *   }
     * }
     */
    public function register(CustomerRegisterRequest $request)
    {
        $data = $request->validated();

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
            'message' => 'Successfully registered!',
            'customer' => $customer
        ], 201);
    }

    /**
     * @group Authentication
     *
     * Logout a user
     *
     * This endpoint logs out the current authenticated user by deleting their access token.
     *
     * @authenticated
     *
     * @response 200 {
     *   "message": "Logged out"
     * }
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out']);
    }
}
