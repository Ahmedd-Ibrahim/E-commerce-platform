<?php
namespace App\Http\Controllers\Api\Order;

use App\Cart\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Order\OrderRequest;

class OrderController extends Controller
{
    protected $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function store(OrderRequest $request)
    {
        if ($this->cart->isEmpty()) {
            return \response()->json(null, 400);
        }

        $order = $this->createOrder($request);
        $order->products()->sync($this->cart->products()->forSyncing());
        $this->cart->empty();

        return response()->json(['message' => 'order created successfully']);
    }

    public function createOrder(Request $request)
    {
        return $request->user()->orders()->create(
            array_merge($request->all(), [
                'subtotal' => $this->cart->subtotal()->amount()
            ])
        );
    }
}
