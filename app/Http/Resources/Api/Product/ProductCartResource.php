<?php
namespace App\Http\Resources\Api\Product;

use App\Cart\Money;

class ProductCartResource extends ProductIndexResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $total = new Money($this->pivot->quantity * $this->price->amount());

        return array_merge(parent::toArray($request), [
            'quantity' => $this->pivot->quantity,
            'total' => $total->formated(),
            'product' => new ProductIndexResource($this->product),
        ]);
    }
}
