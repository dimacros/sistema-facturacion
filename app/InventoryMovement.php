<?php

namespace App;

use App\{Inventory, InvoiceItem};
use Illuminate\Database\Eloquent\Model;

class InventoryMovement extends Model
{
    protected $fillable = [
        'description', 'quantity', 'created_by'
    ];

    public static function descriptionFor($type, InvoiceItem $item) {

        switch ($type) {
            case 'PURCHASE':
                $line = 'NUEVA COMPRA DE %d PRODUCTOS (%s) REGISTRADO EL %s';
                return sprintf($line, $item->quantity, $item->description, $item->created_at);  
            default:
                # code...
                break;
        }
    }
}
