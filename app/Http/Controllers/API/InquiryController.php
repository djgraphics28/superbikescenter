<?php

namespace App\Http\Controllers\API;

use App\Jobs\InquiryResponseJob;
use App\Models\Inquiry;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Mail\InquiryResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class InquiryController extends Controller
{
    /**
     * @group Inquiries
     *
     * Store a newly created Inquiry resource in storage.
     *
     * This endpoint allows you to submit an inquiry about a product.
     *
     * @bodyParam product_id integer required The ID of the product. Example: 1
     * @bodyParam name string required The name of the person making the inquiry. Example: John Doe
     * @bodyParam email string required The email address of the person making the inquiry. Example: john@example.com
     * @bodyParam message string required The message content of the inquiry. Example: I am interested in this product.
     * @bodyParam contact_number string optional The contact number of the person making the inquiry. Example: 123-456-7890
     * @bodyParam province_id string optional The province ID related to the inquiry. Example: 1
     * @bodyParam city_id string optional The city ID related to the inquiry. Example: 1
     * @bodyParam barangay string optional The barangay related to the inquiry. Example: Barangay 1
     *
     * @response {
     *   "message": "Inquiry submitted successfully and response email sent."
     * }
     *
     * @response 404 {
     *   "message": "Product Not Found!"
     * }
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
            'contact_number' => 'nullable|string|max:15',
            'province_id' => 'nullable|string',
            'city_id' => 'nullable|string',
            'barangay' => 'nullable|string|max:255',
        ]);

        $product = Product::find($validatedData['product_id']);

        if (!$product) {
            return response()->json(['message' => 'Product Not Found!'], 404);
        }

        // Prepare the data to be used for the email
        $data = [
            'motorcycle' => $product->name ?? null,
            'model' => $product->model,
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'message' => $validatedData['message'],
            'contact_number' => $validatedData['contact_number'] ?? null,
            'province_id' => $validatedData['province_id'] ?? null,
            'city_id' => $validatedData['city_id'] ?? null,
            'barangay' => $validatedData['barangay'] ?? null,
        ];

        // Save the inquiry to the database
        Inquiry::create($validatedData);

        // Send the response email
        InquiryResponseJob::dispatch($data);

        // Return a success response
        return response()->json(['message' => 'Inquiry submitted successfully and response email sent.']);
    }
}
