<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = [
        'name', 'slug', 'address', 'is_primary', 'company_id'
    ];

    public static function makeSlugFor(string $field) 
    {
        return;
    }
}
