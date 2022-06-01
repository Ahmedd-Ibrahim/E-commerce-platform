<?php
namespace App\Http\Resources\Api\Address;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Country\CountryResource;

class AddressResource extends JsonResource
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
            'country' => new CountryResource($this->country),
            'address_1' => $this->address_1,
            'city' => $this->city,
            'postal_code' => $this->postal_code,
        ];
        return parent::toArray($request);
    }
}
