<?php
namespace App\Http\Controllers\Api\Order;

use App\Cart\Cart;
use App\Events\Order\OrderCreated;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Order\OrderRequest;
use App\Http\Resources\Api\Order\OrderResource;
use App\Cart\Payments\Getway;

class OrderController extends Controller
{
    protected $cart;

    public function __construct(Cart $cart, Getway $getway)
    {
        $this->cart = $cart;
        $this->getway = $getway;
    }

    public function index(Request $request)
    {
        $orders = $request->user()
        ->orders()
        ->with(['products', 'products.product', 'address', 'shippingMethod'])
        ->paginate(10);

        return OrderResource::collection($orders);
    }

    public function store(OrderRequest $request)
    {
        if ($this->cart->isEmpty()) {
            return response()->json(null, 400);
        }

        $order = $this->createOrder($request);
        $order->products()->sync($this->cart->products()->forSyncing());
        $order->load('address', 'products', 'products.product', 'shippingMethod');
        event(new OrderCreated($order));
        return new OrderResource($order);
    }

    public function createOrder(OrderRequest $request)
    {
        return $request->user()->orders()->create(
            array_merge($request->validated(), [
                'subtotal' => $this->cart->subtotal()->amount()
            ])
        );
    }
}
