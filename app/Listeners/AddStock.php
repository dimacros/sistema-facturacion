<?php

namespace App\Listeners;

use App\{Inventory, Store, InventoryMovement};
use App\Events\InvoiceItemCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddStock
{
    /**
     * Handle the event.
     *
     * @param  InvoiceItemCreated  $event
     * @return void
     */
    public function handle(InvoiceItemCreated $event)
    {   
        $inventory = Inventory::firstOrCreate([
            'store_id' => Store::primary()->id,
            'product_id' => $event->item->product_id
        ]);
        $inventory->increment('stock', $event->item->quantity);
        $inventory->movements()->create([
            'description' => InventoryMovement::descriptionFor('PURCHASE', $event->item),
            'quantity' => $event->item->quantity,
            'created_by' => auth()->id()
        ]);
    }
}
