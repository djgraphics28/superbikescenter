<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * @group Products
     *
     * Display a listing of the Product resource.
     *
     * This endpoint allows you to filter products by various criteria and paginate the results.
     *
     * @queryParam name string Search name. Example: Laptop
     * @queryParam brand integer The brand ID of the product. Example: 1
     * @queryParam category integer The category ID of the product. Example: 1
     * @queryParam min_price string The minimum price of the product. Example: 15000
     * @queryParam max_price string The maximum price of the product. Example: 300000
     * @queryParam per_page integer The number of items per page. Example: 10
     *
     * @response {
     *   "data": [
     *     {
     *       "id": 1,
     *       "name": "Product Name",
     *       "slug": "product-name",
     *       "price": 10000,
     *       "category_id": 1,
     *       "brand_id": 1,
     *       "created_at": "2024-07-26T00:00:00.000000Z",
     *       "updated_at": "2024-07-26T00:00:00.000000Z"
     *     }
     *   ],
     *   "links": {
     *     "first": "http://example.com/api/products?page=1",
     *     "last": "http://example.com/api/products?page=1",
     *     "prev": null,
     *     "next": null
     *   },
     *   "meta": {
     *     "current_page": 1,
     *     "from": 1,
     *     "last_page": 1,
     *     "path": "http://example.com/api/products",
     *     "per_page": 10,
     *     "to": 1,
     *     "total": 1
     *   }
     * }
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

    /**
     * @group Products
     *
     * Display the specified product.
     *
     * This endpoint retrieves a specific product by its slug.
     *
     * @urlParam slug string required The slug of the product. Example: product-name
     *
     * @response {
     *   "data": {
     *     "id": 1,
     *     "name": "Product Name",
     *     "slug": "product-name",
     *     "price": 10000,
     *     "category_id": 1,
     *     "brand_id": 1,
     *     "variations": [],
     *     "created_at": "2024-07-26T00:00:00.000000Z",
     *     "updated_at": "2024-07-26T00:00:00.000000Z"
     *   }
     * }
     */
    public function show(string $slug)
    {
        $product = Product::with('variations')->whereSlug($slug)->firstOrFail();

        return response()->json(new ProductResource($product));
    }
}
