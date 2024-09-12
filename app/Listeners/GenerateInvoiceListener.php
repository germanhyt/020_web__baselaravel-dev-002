<?php

namespace App\Listeners;

use App\Events\createOrderEvent;
use App\Models\Invoice;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GenerateInvoiceListener
{

    public Invoice $invoice;

    /**
     * Create the event listener.
     */
    public function __construct(Invoice $invoice)
    {
        //
        $this->invoice = $invoice;
    }

    /**
     * Handle the event.
     */
    public function handle(createOrderEvent $event): void
    {
        //
        Invoice::create([
            'amount' => $event->order->amount,
            'order_id' => $event->order->id
        ]);
    }
}
