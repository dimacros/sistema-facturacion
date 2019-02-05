<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'store_id', 'product_id'
    ];

    public function movements() {
        return $this->hasMany(InventoryMovement::class);
    }
}
