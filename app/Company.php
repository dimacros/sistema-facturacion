<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'ruc', 'name', 'subdomain'
    ];

    public function scopeFindByRuc($query, $ruc)
    {   
        return $query->whereRuc($ruc)->first();
    }
}
