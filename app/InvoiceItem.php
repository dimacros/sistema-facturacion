<?php

namespace App;

use App\Events\InvoiceItemCreated;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $fillable = [
        'product_id', 'code', 'description', 'quantity', 'price'
    ];

    protected $attributes = [
        'tax_exemption_reason_code' => '10'
    ];

    protected $dispatchesEvents = [
        'created' => InvoiceItemCreated::class
    ];
}
