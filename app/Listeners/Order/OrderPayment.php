<?php
namespace App\Listeners\Order;

use App\Cart\Payments\Getway;
use App\Events\Order\OrderCreated;

class OrderPayment
{
    public $getway;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Getway $getway)
    {
        $this->getway = $getway;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        try {
            $order = $event->order;
            $this->getway->withUser($order->user)
        ->getCustomer()
        ->charge(
            $order->PaymentMethod,
            $order->total->amount()
        );
        } catch (\Throwable $th) {
          //  evnet(new OrderPaymentFailed);
        }
    }
}
