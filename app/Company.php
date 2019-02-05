<?php

namespace App;

use App\Events\CompanyCreated;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'ruc', 'name', 'subdomain'
    ];

    protected $dispatchesEvents = [
        'created' => CompanyCreated::class
    ];

    public function scopeFindByRuc($query, $ruc)
    {   
        return $query->whereRuc($ruc)->first();
    }
}
