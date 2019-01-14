<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use Tenant;

    protected $fillable = [
        'document_type', 
        'document_value', 
        'company_name', 
        'address', 
        'type', 
        'contact', 
        'company_id'
    ];
    
    public function setContactAttribute($value) 
    {
        $default = ['name', 'email', 'phone'];
        $nicenames = ['Nombre', 'Correo', 'Teléfono'];

        $this->attributes['contact'] = str_replace($default, $nicenames, $value);
    }
}
