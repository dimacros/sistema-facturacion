<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\CompanyCreated;
use App\Store;

class CreateStoreByDefault
{
    private $store;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CompanyCreated $event)
    {
        $this->store->create([
            'name' => 'Principal', 
            'address' => '-',
            'is_primary' => 1,
            'company_id' => $event->company->id
        ]);
    }
}
