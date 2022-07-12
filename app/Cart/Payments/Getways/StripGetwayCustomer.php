<?php
namespace App\Cart\Payments\Getways;

use App\Cart\Payments\Getway;
use App\Models\PaymentMethod;
use App\Cart\Payments\GetwayCustomer;
use App\Exceptions\PaymentFailedException;
use Stripe\Customer as StripCustomer;
use Stripe\Charge as StripCharge;

class StripGetwayCustomer implements GetwayCustomer
{
    protected $getway;

    protected $stripCustomer;

    public function __construct(Getway $getway, StripCustomer $stripCustomer)
    {
        $this->getway = $getway;
        $this->stripCustomer = $stripCustomer;
    }

    public function charge(PaymentMethod $paymentMethod, $amount)
    {
        try {
            $charge = StripCharge::create([
                'currency' => 'USD',
                'amount' => $amount,
                'customer' => $this->stripCustomer->id,
                'source' => $paymentMethod->provider_id
            ]);
        } catch (\Throwable $th) {
            throw new PaymentFailedException($th->getMessage());
        }

        return $charge;
    }

    public function addCard($token)
    {
        $card = $this->stripCustomer->sources->create([
            'source' => $token
        ]);

        $this->getway->user()->paymentMethods()->create([
            'card_type' => $card->brand,
            'last_four' => $card->last4,
            'provider_id' => $card->id,
            'default' => true
        ]);

        return $this;
    }

    public function id()
    {
        return $this->stripCustomer->id;
    }
}
