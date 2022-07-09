<?php
namespace App\Cart\Payments\Getways;

use Stripe\Customer as StripCustomer;
use App\Models\User;
use App\Cart\Payments\Getway;

class StripGetway implements Getway
{
    protected $user;

    /**
     * withUser
     *
     * @param  mixed $user
     * @return void
     */
    public function withUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * createCustomer
     *
     * @return void
     */
    public function createCustomer()
    {
        if ($this->user->getway_customer_id) {
            return $this->getCustomer();
        }

        $customer = new StripGetwayCustomer($this, $this->createStripCustomer());

        $this->user->update(['getway_customer_id' => $customer->id()]);

        return $customer;
    }

    protected function createStripCustomer()
    {
        return StripCustomer::create([
            'email' => $this->user->email,
        ]);
    }

    protected function getCustomer()
    {
        $customer = new StripGetwayCustomer($this, StripCustomer::retrieve($this->user->getway_customer_id));

        return $customer;
    }

    public function user()
    {
        return $this->user;
    }
}
