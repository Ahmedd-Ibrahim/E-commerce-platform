<?php
namespace App\Http\Requests\Api\PaymentMethod;

use Illuminate\Foundation\Http\FormRequest;

class PaymentMethodRequest extends FormRequest
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
            'card_type' => ['string', 'sometimes', 'min:3'],
            'last_four' => ['numeric', 'sometimes', 'min:4'],
            'default' => ['boolean', 'required'],
            'provider_id' => ['string', 'required']
        ];
    }
}
