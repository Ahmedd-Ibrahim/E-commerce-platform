<?php
namespace App\Cart;

use App\Models\User;

class Cart
{
    protected $user;

    public function __construct(?User $user)
    {
        $this->user = $user;
    }

    public function products()
    {
        return $this->user->cart;
    }

    public function add($products)
    {
        $this->user->cart()->syncWithoutDetaching(
            $this->getStorePayload($products)
        );
    }

    public function update($variationId, $quantity)
    {
        return $this->user->cart()->updateExistingPivot($variationId, [
            'quantity' => $quantity
        ]);
    }

    public function detach($variationId)
    {
        return $this->user->cart()->detach($variationId);
    }

    public function empty()
    {
        return $this->user->cart()->detach();
    }

    public function isEmpty()
    {
        return $this->user->cart->sum('pivot.quantity') == 0;
    }

    public function sync()
    {
        $this->user->cart->each(function ($product) {
            $quantity = $product->minStock($product->pivot->quantity);

            $product->pivot->update(['quantity' => $quantity]);
        });
    }

    public function total()
    {
        return $this->user->cart->sum('total');
    }

    public function subtotal()
    {
        $subtotal = $this->user->cart->sum(function ($product) {
            return $product->price->amount() * $product->pivot->quantity;
        });

        return new Money($subtotal);
    }

    protected function getStorePayload($products)
    {
        return collect($products)
        ->keyBy('id')
        ->map(fn ($product) => ['quantity' => $product['quantity'] + $this->getCurrentQuantity($product['id'])])
        ->toArray();
    }

    protected function getCurrentQuantity($productId)
    {
        if ($product = $this->user->cart->where('id', $productId)->first()) {
            return $product->pivot->quantity;
        }

        return 0;
    }
}
