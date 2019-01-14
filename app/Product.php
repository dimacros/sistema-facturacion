<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Tenant;
    
    const CODE_PREFIX = 'P';
    
    protected $fillable = [
        'code', 
        'description', 
        'images', 
        'currency_code',
        'unit_code', 
        'price', 
        'groups', 
        'company_id'
    ];

    public function getRenderPriceAttribute()
    {
        return number_format($this->price, 2) . ' ' . $this->currency_code;
    }
}
