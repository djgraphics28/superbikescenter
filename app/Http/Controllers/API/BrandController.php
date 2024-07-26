<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    /**
     * @group Brands
     *
     * Display a listing of the Brand resource.
     *
     * This endpoint retrieves a list of all brands.
     *
     * @response {
     *   "data": [
     *     {
     *       "id": 1,
     *       "name": "Brand Name",
     *       "image": "http://example.com/storage/brand-image.jpg"
     *     }
     *   ]
     * }
     */
    public function getBrands()
    {
        $brands = Brand::all();

        return response()->json(BrandResource::collection($brands));
    }
}
