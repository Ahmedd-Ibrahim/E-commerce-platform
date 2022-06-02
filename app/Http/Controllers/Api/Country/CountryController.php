<?php
namespace App\Http\Controllers\Api\Country;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Country\CountryResource;
use App\Models\Country;

class CountryController extends Controller
{
    public function index()
    {
        return response()->json(CountryResource::collection(Country::get()));
    }
}
