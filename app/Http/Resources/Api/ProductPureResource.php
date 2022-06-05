<?php
namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductPureResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price->formated(),
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
