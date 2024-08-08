<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\MonthlyDueResource;
use App\Models\Customer;
use App\Models\Application;
use App\Models\MonthlyDue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicationSuccessResponseMail;

class ApplicationController extends Controller
{
    /**
     * @group Applications
     *
     * Submit a new application
     *
     * This endpoint allows a user to submit a new application.
     *
     * @bodyParam customer_id int required The ID of the customer. Example: 1
     * @bodyParam product int required The ID of the product. Example: 2
     * @bodyParam source_of_income string required The source of income. Example: Employment
     * @bodyParam name_of_business string The name of the business (if any). Example: My Business
     * @bodyParam company_name string The name of the company (if any). Example: My Company
     * @bodyParam work_position string The position at work (if any). Example: Manager
     * @bodyParam years_in_work int The number of years in work (if any). Example: 5
     * @bodyParam comaker_name string The name of the comaker (if any). Example: John Doe
     * @bodyParam comaker_work string The work of the comaker (if any). Example: Engineer
     * @bodyParam comaker_monthly_income float The monthly income of the comaker (if any). Example: 50000
     * @bodyParam months_to_pay int required The number of months to pay. Example: 12
     * @bodyParam monthly_payment_amount float required The amount to be paid monthly. Example: 1000
     * @bodyParam monthly_income float required The monthly income. Example: 2000
     * @bodyParam downpayment float required The downpayment amount. Example: 500
     * @bodyParam loan_amount float required The loan amount. Example: 10000
     * @bodyParam name string required The name of the applicant. Example: Jane Doe
     * @bodyParam email string required The email of the applicant. Example: jane@example.com
     *
     * @response 200 {
     *   "message": "Loan Application submitted successfully."
     * }
     * @response 400 {
     *   "error": "You already have an active loan application."
     * }
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'customer_id' => 'required|integer',
            'product' => 'required|integer',
            'source_of_income' => 'required|string|max:255',
            'name_of_business' => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'work_position' => 'nullable|string|max:255',
            'years_in_work' => 'nullable|integer',
            'comaker_name' => 'nullable|string|max:255',
            'comaker_work' => 'nullable|string|max:255',
            'comaker_monthly_income' => 'nullable|numeric',
            'months_to_pay' => 'required|integer',
            'monthly_payment_amount' => 'required|numeric',
            'monthly_income' => 'required|numeric',
            'downpayment' => 'required|numeric',
            'loan_amount' => 'required|numeric',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        // Check for existing active applications
        $checkApplication = Application::where('customer_id', $request->customer_id)
            ->whereIn('status', ['for-review', 'for-ci', 'approved', 'in-progress'])
            ->first();

        if (!$checkApplication) {
            // Create new application
            Application::create([
                'customer_id' => $request->customer_id,
                'product_id' => $request->product,
                'source_of_income' => $request->source_of_income,
                'name_of_business' => $request->name_of_business,
                'company_name' => $request->company_name,
                'work_position' => $request->work_position,
                'years_in_work' => $request->years_in_work,
                'comaker_name' => $request->comaker_name,
                'comaker_work' => $request->comaker_work,
                'comaker_monthly_income' => $request->comaker_monthly_income,
                'months_to_pay' => $request->months_to_pay,
                'monthly_payment_amount' => $request->monthly_payment_amount,
                'monthly_income' => $request->monthly_income,
                'downpayment' => $request->downpayment,
                'loan_amount' => $request->loan_amount,
                'date_applied' => now(),
                'date_inquired' => now(),
            ]);

            // Prepare email data
            $emailData = [
                'name' => $request->name,
                'loanAmount' => $request->loan_amount,
                'downpayment' => $request->downpayment,
                'monthlyPaymentAmount' => $request->monthly_payment_amount,
                'monthsToPay' => $request->months_to_pay,
                'url' => route('profile'),
            ];

            // Send email
            Mail::to($request->email)->send(new ApplicationSuccessResponseMail($emailData));

            return response()->json(['message' => 'Application submitted successfully.'], 200);
        } else {
            return response()->json(['error' => 'You already have an active application.'], 400);
        }
    }

    /**
     * @group Applications
     *
     * Get applications by customer ID
     *
     * This endpoint retrieves all applications for a specific customer.
     *
     * @urlParam customer_id int required The ID of the customer. Example: 1
     *
     * @response 200 {
     *   "applications": [
     *     {
     *       "id": 1,
     *       "customer_id": 1,
     *       "product_id": 2,
     *       "source_of_income": "Employment",
     *       "name_of_business": "My Business",
     *       "company_name": "My Company",
     *       "work_position": "Manager",
     *       "years_in_work": 5,
     *       "comaker_name": "John Doe",
     *       "comaker_work": "Engineer",
     *       "comaker_monthly_income": 50000,
     *       "months_to_pay": 12,
     *       "monthly_payment_amount": 1000,
     *       "monthly_income": 2000,
     *       "downpayment": 500,
     *       "loan_amount": 10000,
     *       "date_applied": "2024-07-26T00:00:00.000000Z",
     *       "date_inquired": "2024-07-26T00:00:00.000000Z",
     *       "status": "for-review",
     *       "created_at": "2024-07-26T00:00:00.000000Z",
     *       "updated_at": "2024-07-26T00:00:00.000000Z"
     *     }
     *   ]
     * }
     *
     * @response 404 {
     *   "error": "No applications found."
     * }
     */
    public function getApplication($id)
    {
        $customerId = Customer::where('user_id', $id)->first()->id;
        $applications = Application::where('customer_id', $customerId)->get();

        if ($applications->isEmpty()) {
            return response()->json(['error' => 'No applications found.'], 404);
        }

        return response()->json(['applications' => $applications], 200);
    }

    /**
     * Get monthly dues for a specific application.
     *
     * @group Monthly Dues
     *
     * @param int $applicationId The ID of the application.
     *
     * @response 200 {
     *   "monthlyDues": [
     *     {
     *       "id": 1,
     *       "application_id": 1,
     *       "due_date": "2024-08-01",
     *       "amount_due": 5000,
     *       "amount_paid": 1000,
     *       "status": "unpaid"
     *     },
     *     {
     *       "id": 2,
     *       "application_id": 1,
     *       "due_date": "2024-09-01",
     *       "amount_due": 5000,
     *       "amount_paid": 0,
     *       "status": "unpaid"
     *     }
     *   ]
     * }
     * @response 404 {
     *   "error": "Not yet Approved, no monthly dues found."
     * }
     */
    public function getMonthlyDues($applicationId)
    {
        // Retrieve monthly dues based on the application ID.
        $monthlyDues = MonthlyDue::where('application_id', $applicationId)->get();

        if ($monthlyDues->isEmpty()) {
            return response()->json(['error' => 'Not yet Approved, no monthly dues found.'], 404);
        }

        return response()->json(['monthlyDues' => MonthlyDueResource::collection($monthlyDues)], 200);
    }


    /**
     * Pay the monthly due.
     *
     * @group Payments
     *
     * @param Request $request The request instance.
     * @param int $monthlyDueId The ID of the monthly due.
     *
     * @bodyParam amount_paid float required The amount paid by the user. Example: 1000.00
     * @bodyParam receipt_number string required The receipt number of the payment. Example: REC123456789
     * @bodyParam payment_method string required The method of payment (e.g., credit card, bank transfer). Example: credit_card
     * @bodyParam payment_gateway string The payment gateway used for the transaction. Example: PayPal
     * @bodyParam transaction_id string The transaction ID from the payment gateway. Example: TXN123456789
     *
     * @response 200 {
     *   "message": "Payment successful",
     *   "monthly_due": {
     *     "id": 1,
     *     "user_id": 1,
     *     "amount_due": 5000,
     *     "amount_paid": 1000,
     *     "status": "paid",
     *     "receipt_number": "REC123456789",
     *     "payment_method": "credit_card"
     *   }
     * }
     * @response 404 {
     *   "error": "monthly due not found."
     * }
     */
    public function payMonthlyDue(Request $request, $monthlyDueId)
    {
        $monthlyDue = MonthlyDue::find($monthlyDueId);

        if (!$monthlyDue) {
            return response()->json(['error' => 'monthly due not found.'], 404);
        }

        $monthlyDue->update([
            'amount_paid' => $request->amount_paid,
            'status' => "paid",
            'receipt_number' => $request->receipt_number,
            'payment_method' => $request->payment_method
        ]);

        PaymentHistory::create([
            'user_id' => $monthlyDue->user_id,
            'monthly_due_id' => $monthlyDueId,
            'amount_paid' => $request->amount_paid,
            'payment_method' => $request->payment_method,
            'payment_gateway' => $request->payment_gateway,
            'transaction_id' => $request->transaction_id
        ]);

        return response()->json([
            'message' => 'Payment successful',
            'monthly_due' => $monthlyDue
        ], 200);
    }

    /**
     * Get payment histories for a specific user.
     *
     * @group Payment Histories
     *
     * @param int $userId The ID of the user.
     *
     * @response 200 {
     *   "paymentHistories": [
     *     {
     *       "id": 1,
     *       "user_id": 1,
     *       "monthly_due_id": 1,
     *       "amount_paid": 1000,
     *       "payment_method": "credit_card",
     *       "payment_gateway": "PayPal",
     *       "transaction_id": "TXN123456789",
     *       "created_at": "2024-08-01T12:34:56.000000Z",
     *       "updated_at": "2024-08-01T12:34:56.000000Z"
     *     },
     *     {
     *       "id": 2,
     *       "user_id": 1,
     *       "monthly_due_id": 2,
     *       "amount_paid": 1500,
     *       "payment_method": "bank_transfer",
     *       "payment_gateway": "Stripe",
     *       "transaction_id": "TXN987654321",
     *       "created_at": "2024-08-05T14:23:45.000000Z",
     *       "updated_at": "2024-08-05T14:23:45.000000Z"
     *     }
     *   ]
     * }
     * @response 404 {
     *   "error": "No payment histories found for this user."
     * }
     */
    public function getPaymentHistories($userId)
    {
        // Retrieve payment histories based on the user ID.
        $paymentHistories = PaymentHistory::where('user_id', $userId)->get();

        if ($paymentHistories->isEmpty()) {
            return response()->json(['error' => 'No payment histories found for this user.'], 404);
        }

        return response()->json(['paymentHistories' => PaymentHistoryResource::collection($paymentHistories)], 200);
    }


}
