<?php
namespace App\Http\Controllers\Api;

use App\Cart\Cart;
use App\Models\Variation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreCartRequest;
use App\Http\Resources\Api\Cart\CartResource;
use App\Http\Requests\Api\Cart\UpdateCartRequest;

class CartController extends Controller
{
    protected $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
        $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        $request->user();
        return new CartResource($request->user());
    }

    public function store(StoreCartRequest $storeCartRequest)
    {
        $this->cart->add($storeCartRequest->products);
        return response()->json(['message' => 'products added successfully']);
    }

    public function update(Variation $variation, UpdateCartRequest $request)
    {
        $this->cart->update($variation->id, $request->quantity);

        return response()->json(['message' => 'product updated successfully']);
    }

    public function destroy(Variation $variation)
    {
        $this->cart->detach($variation->id);

        return response()->json(['message' => 'product removed successfully']);
    }

    public function empty()
    {
        $this->cart->empty();

        return response()->json(['message' => 'cart is empty']);
    }
}
