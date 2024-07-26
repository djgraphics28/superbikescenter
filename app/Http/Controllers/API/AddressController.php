<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Yajra\Address\Entities\Barangay;
use Yajra\Address\Entities\City;
use App\Http\Controllers\Controller;
use Yajra\Address\Entities\Province;

class AddressController extends Controller
{
    /**
     * @group Addresses
     *
     * Get all provinces
     *
     * This endpoint retrieves all provinces.
     *
     * @response 200 {
     *   "provinces": [
     *     {
     *       "id": 1,
     *       "name": "Province 1",
     *       "created_at": "2024-07-26T00:00:00.000000Z",
     *       "updated_at": "2024-07-26T00:00:00.000000Z"
     *     },
     *     {
     *       "id": 2,
     *       "name": "Province 2",
     *       "created_at": "2024-07-26T00:00:00.000000Z",
     *       "updated_at": "2024-07-26T00:00:00.000000Z"
     *     }
     *   ]
     * }
     */
    public function getProvinces()
    {
        $provinces = Province::all();

        return response()->json(['provinces' => $provinces]);
    }

    /**
     * @group Addresses
     *
     * Get cities by province ID
     *
     * This endpoint retrieves all cities belonging to a specific province.
     *
     * @urlParam provinceId int required The ID of the province. Example: 1
     *
     * @response 200 {
     *   "cities": [
     *     {
     *       "id": 1,
     *       "province_id": 1,
     *       "name": "City 1",
     *       "created_at": "2024-07-26T00:00:00.000000Z",
     *       "updated_at": "2024-07-26T00:00:00.000000Z"
     *     },
     *     {
     *       "id": 2,
     *       "province_id": 1,
     *       "name": "City 2",
     *       "created_at": "2024-07-26T00:00:00.000000Z",
     *       "updated_at": "2024-07-26T00:00:00.000000Z"
     *     }
     *   ]
     * }
     * @response 404 {
     *   "error": "Province not found."
     * }
     */
    public function getCities($provinceId)
    {
        $cities = City::where('province_id', $provinceId)->get();

        return response()->json(['cities' => $cities]);
    }

    /**
     * @group Addresses
     *
     * Get barangays by city ID
     *
     * This endpoint retrieves all barangays belonging to a specific city.
     *
     * @urlParam cityId int required The ID of the city. Example: 1
     *
     * @response 200 {
     *   "barangays": [
     *     {
     *       "id": 1,
     *       "city_id": 1,
     *       "name": "Barangay 1",
     *       "created_at": "2024-07-26T00:00:00.000000Z",
     *       "updated_at": "2024-07-26T00:00:00.000000Z"
     *     },
     *     {
     *       "id": 2,
     *       "city_id": 1,
     *       "name": "Barangay 2",
     *       "created_at": "2024-07-26T00:00:00.000000Z",
     *       "updated_at": "2024-07-26T00:00:00.000000Z"
     *     }
     *   ]
     * }
     * @response 404 {
     *   "error": "City not found."
     * }
     */
    public function getBarangays($cityId)
    {
        $barangays = Barangay::where('city_id', $cityId)->get();

        return response()->json(['barangays' => $barangays]);
    }
}
