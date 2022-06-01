<?php
namespace App\Http\Requests\Api\Address;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['string', 'required'],
            'address_1' => ['required', 'string'],
            'city' => ['required', 'string'],
            'postal_code' => ['required', 'numeric'],
            'country_id' => ['required', 'exists:countries,id'],
        ];
    }
}
