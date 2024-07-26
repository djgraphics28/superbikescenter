<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailVerificationController extends Controller
{
    /**
     * @group Email Verification
     *
     * Show the email verification notice
     *
     * This endpoint shows the email verification notice.
     *
     * @authenticated
     *
     * @response 200 {
     *   "message": "Please verify your email address."
     * }
     */
    public function notice()
    {
        return response()->json(['message' => 'Please verify your email address.'], 200);
    }

    /**
     * @group Email Verification
     *
     * Verify email address
     *
     * This endpoint verifies the user's email address.
     *
     * @urlParam id string required The ID of the user. Example: 1
     * @urlParam hash string required The email verification hash. Example: abc123
     * @authenticated
     *
     * @response 200 {
     *   "message": "Email verified successfully."
     * }
     * @response 400 {
     *   "message": "Invalid or expired verification link."
     * }
     */
    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return response()->json(['message' => 'Email verified successfully.'], 200);
    }

    /**
     * @group Email Verification
     *
     * Resend email verification notification
     *
     * This endpoint resends the email verification notification.
     *
     * @authenticated
     *
     * @response 200 {
     *   "message": "Verification link sent!"
     * }
     * @response 429 {
     *   "message": "Too many requests. Please try again later."
     * }
     */
    public function send(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return response()->json(['message' => 'Verification link sent!'], 200);
    }
}
