<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Store extends Model
{
    use Sluggable, SoftDeletes, Tenant;

    protected $fillable = [
        'name', 'slug', 'address', 'is_primary', 'company_id'
    ];

    protected $dates = ['deleted_at'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable() {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function url() {
        return url('tiendas/' . $this->slug);
    }

    public static function primary() {
        return self::where(['is_primary' => 1,'company_id' => auth()->user()->company_id])->first();
    }

    public function inventory() {
        return $this->hasMany(Inventory::class);
    }
}
