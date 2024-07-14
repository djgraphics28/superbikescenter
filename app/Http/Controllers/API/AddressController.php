<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Yajra\Address\Entities\Barangay;
use Yajra\Address\Entities\City;
use App\Http\Controllers\Controller;
use Yajra\Address\Entities\Province;

class AddressController extends Controller
{
    public function getProvinces()
    {
        $provinces = Province::all();

        return response()->json($provinces);
    }

    public function getCities($provinceId)
    {
        $cities = City::where('province_id', $provinceId)->get();

        return response()->json($cities);
    }

    public function getBarangays($cityId)
    {
        $barangays = Barangay::where('city_id', $cityId)->get();

        return response()->json($barangays);
    }
}
