<?php
namespace App\Http\Resources\Api\Order;

use App\Http\Resources\Api\VariationResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Address\AddressResource;

class OrderResource extends JsonResource
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
            'id' => $this->id,
            'status' => $this->status,
            'subtotal' => $this->subtotal->formated(),
            'total' => $this->total->formated(),
            'updated_at' => $this->updated_at->toDateTimeString(),
            'products' => VariationResource::collection($this->whenLoaded('products')),
            'address' => new AddressResource($this->whenLoaded('address')),
            'shipping_method' => new ShippingMethodResource($this->whenLoaded('shippingMethod'))
        ];
    }
}
