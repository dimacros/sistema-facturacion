<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles, Tenant;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'company_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function stores()
    {
        return $this->belongsToMany(Store::class, 'user_store');
    }

    public function canMangeStores()
    {
        return $this->hasRole('admin') || ( $this->stores->count() > 1 );
    }

    public function fullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
