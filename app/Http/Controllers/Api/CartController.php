<?php
namespace App\Http\Controllers\Api;

use App\Cart\Cart;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreCartRequest;

class CartController extends Controller
{
    protected $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
        $this->middleware('auth:api');
    }

    public function store(StoreCartRequest $storeCartRequest)
    {
        $this->cart->add($storeCartRequest->products);
        return response()->json(['message' => 'products added successfully']);
    }
}
