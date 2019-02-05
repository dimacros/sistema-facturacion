<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use Tenant, SoftDeletes;
    
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

    protected $dates = ['deleted_at'];
    
    protected $visible = ['id', 'code', 'description', 'price'];

    public static function prefix() 
    {
        return self::CODE_PREFIX;
    }

    public function getPriceAttribute($value) 
    {
        return number_format($value, 2, '.', '');
    }

    public function scopeSearch($query, $search)  
    {   
        if( is_null($search) || empty($search) ) {
            return $query;
        }

        return $query->where('code', 'LIKE', "%{$search}%")
                     ->orWhere('description', 'LIKE', "%{$search}%");
    }
}
