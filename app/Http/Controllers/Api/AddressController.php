<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Address\AddressRequest;
use App\Http\Resources\Api\Address\AddressResource;
use App\Models\Address;

class AddressController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    public function index(Request $request)
    {
        return AddressResource::collection($request->user()->addresses);
    }

    public function store(AddressRequest $request)
    {
        $address = Address::make($request->validated());

        $request->user()->addresses()->save($address);

        return response()->json(new AddressResource($address));
    }

    public function update(Address $address, AddressRequest $addressRequest)
    {
        $address->update($addressRequest->validated());

        return response()->json(['message' => 'updated successfully']);
    }

    public function show(Address $address)
    {
        return response()->json(new AddressResource($address));
    }

    public function destroy(Address $address)
    {
        $address->delete();

        return response()->json(['message' => 'deleted']);
    }
}
