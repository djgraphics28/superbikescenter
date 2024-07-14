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
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created Inquiry resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'product_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
            'contact_number' => 'nullable|string|max:15',
            'province_id' => 'nullable|string',
            'city_id' => 'nullable|string',
            'barangay' => 'nullable|string|max:255',
        ]);

        $product = Product::find($validatedData['product_id']);

        if(!$product) {
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

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(string $id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, string $id)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(string $id)
    // {
    //     //
    // }
}
