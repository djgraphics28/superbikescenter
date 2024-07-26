<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * @group Categories
     *
     * Display a listing of the Categories resource.
     *
     * This endpoint retrieves a list of all categories.
     *
     * @response {
     *   "data": [
     *     {
     *       "id": 1,
     *       "name": "Category Name",
     *       "image": "http://example.com/storage/category-image.jpg"
     *     }
     *   ]
     * }
     */
    public function getCategories()
    {
        $categories = Category::all();

        return response()->json(CategoryResource::collection($categories));
    }
}
