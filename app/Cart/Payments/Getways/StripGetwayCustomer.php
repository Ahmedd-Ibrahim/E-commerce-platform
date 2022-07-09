<?php

namespace App\Cart\Payments\Getways;

use App\Cart\Payments\Getway;
use App\Models\PaymentMethod;
use App\Cart\Payments\GetwayCustomer;
use Stripe\Customer as StripCustomer;

class StripGetwayCustomer implements GetwayCustomer
{
    protected $getway;

    protected $stripCustomer;

    public function __construct(Getway $getway, StripCustomer $stripCustomer)
    {
        $this->getway = $getway;
        $this->stripCustomer = $stripCustomer;
    }

    public function charge(PaymentMethod $card, $amount)
    {

    }

    public function addCard($token)
    {
       $card = $this->stripCustomer->sources->create([
        'source' => $token
       ]);

       return $this->getway->user()->paymentMethods()->create([
       'card_type' => $card->brand,
        'last_four' => $card->last4,
        'provider_id'=> $card->id,
        'default' => true
       ]);
    }

    public function id()
    {
        return $this->stripCustomer->id;
    }
}
