<?php
namespace App\Http\Resources\Api\Product;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class ProductVariationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->resource instanceof Collection) {
            return ProductVariationResource::collection($this->resource);
        }

        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'variation_type_id' => $this->variation_type_id,
            'name' => $this->name,
            'price' => $this->formated_price,
            'order' => $this->order,
            'available' => $this->inStock(),
            'stock' => $this->stockCount(),
        ];
    }
}
