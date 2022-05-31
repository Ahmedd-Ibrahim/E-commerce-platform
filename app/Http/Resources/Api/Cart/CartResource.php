<?php
namespace App\Http\Resources\Api\Cart;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Product\ProductCartResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'products' => ProductCartResource::collection($this->cart)
        ];
    }
}
