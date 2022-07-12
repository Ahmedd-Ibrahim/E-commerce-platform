<?php

namespace App\Listeners\Order;

use App\Models\Order;
use App\Events\Order\OrderPayemntFailed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MarkOrderAsFailed
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(OrderPayemntFailed $event)
    {
        $event->order->update(['status' => Order::PAYMENT_FAILED]);
    }
}
