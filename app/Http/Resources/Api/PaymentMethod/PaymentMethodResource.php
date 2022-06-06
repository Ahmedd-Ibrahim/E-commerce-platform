<?php
namespace App\Http\Resources\Api\PaymentMethod;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentMethodResource extends JsonResource
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
            'user' => $this->whenLoaded('user'),
            'card_type' => $this->card_type,
            'last_four' => $this->last_four,
            'default' => $this->default,
            'provider_id' => $this->provider_id,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
        return parent::toArray($request);
    }
}
