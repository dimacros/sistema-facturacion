<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use Tenant;

    const SUPPLIER = 'PROVEEDOR';
    const CONSUMER = 'CONSUMIDOR';
    
    protected $fillable = [
        'document_type', 
        'document_value', 
        'company_name', 
        'address', 
        'type', 
        'contact', 
        'company_id'
    ];
    
    protected $visible = ['id', 'document_value', 'address', 'company_name', 'contact', 'type'];

    public function scopeSearch($query, $search) 
    {   
        if( is_null($search) || empty($search) ) {
            return $query;
        }

        return $query->where('company_name', 'LIKE', "%{$search}%")
                     ->orWhere('document_value', 'LIKE', "%{$search}%")
                     ->orWhere('type', 'LIKE', "%{$search}%");
    }
}
