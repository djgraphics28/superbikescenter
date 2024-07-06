<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the Product resource.
     */
    public function index(Request $request)
    {
        // Start with a base query
        $query = Product::query();

        // Filter by category if provided
        if ($request->has('category')) {
            $query->where('category_id', $request->input('category'));
        }

        // Filter by brand if provided
        if ($request->has('brand')) {
            $query->where('brand_id', $request->input('brand'));
        }

        // Filter by price range if provided
        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->input('min_price'));
        }
        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->input('max_price'));
        }

        // Filter by name if provided
        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        // Set the number of items per page
        $perPage = $request->input('per_page', 10); // Default to 10 items per page if not provided

        // Get the filtered products with pagination
        $products = $query->paginate($perPage);

        // Return the paginated response
        return response()->json(ProductResource::collection($products)->response()->getData(true));
    }


    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  */
    public function show(string $slug)
    {
        $product = Product::with('variations')->whereSlug($slug)->firstOrFail();

        return response()->json(new ProductResource($product));
    }

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
