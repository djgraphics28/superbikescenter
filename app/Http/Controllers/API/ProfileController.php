<?php

namespace App\Http\Controllers\API;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;

class ProfileController extends Controller
{
     /**
     * @group Customers
     *
     * Get customer profile by user ID
     *
     * This endpoint retrieves a customer's profile based on their user ID.
     *
     * @urlParam id int required The ID of the user. Example: 1
     *
     * @response 200 {
     *   "customer": {
     *     "id": 1,
     *     "user_id": 1,
     *     "first_name": "John",
     *     "middle_name": "M",
     *     "last_name": "Doe",
     *     "sufix_name": "Jr",
     *     "contact_number": "1234567890",
     *     "birth_date": "1990-01-01",
     *     "gender": "Male",
     *     "marital_status": "Single",
     *     "is_active": true,
     *     "province_id": 1,
     *     "city_id": 1,
     *     "barangay_id": 1,
     *     "address1": "123 Main St",
     *     "address2": "Apt 4B",
     *   }
     * }
     *
     * @response 404 {
     *   "error": "Customer not found."
     * }
     */
    public function show($id)
    {
        $customer = Customer::where('user_id', $id)->first();

        if (!$customer) {
            return response()->json(['error' => 'Customer not found.'], 404);
        }

        return response()->json(['customer' => $customer], 200);
    }

    /**
     * @group Users
     *
     * Change Password
     *
     * This endpoint allows a user to change their password.
     *
     * @bodyParam current_password string required The current password of the user. Example: old_password
     * @bodyParam new_password string required The new password for the user. Example: new_password123
     * @bodyParam new_password_confirmation string required The confirmation of the new password. Example: new_password123
     *
     * @response 200 {
     *   "message": "Password changed successfully."
     * }
     * @response 400 {
     *   "error": "Current password is incorrect."
     * }
     * @response 422 {
     *   "error": "The new password confirmation does not match."
     * }
     */
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['error' => 'Current password is incorrect.'], 400);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['message' => 'Password changed successfully.'], 200);
    }
}
