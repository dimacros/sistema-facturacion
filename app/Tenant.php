<?php

namespace App;

use Illuminate\Database\Eloquent\{Builder, Model};

trait Tenant
{
    public function scopePerCompany($query) 
    {
        return $query->where('company_id', auth()->user()->company_id);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $attribute
     * @param array $config
     * @param string $slug
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithUniqueSlugConstraints(Builder $query, Model $model, $attribute, $config, $slug)
    {
        return $query->where('company_id', $model->company_id);
    }

    /**
     * Get all of the models from the database.
     *
     * @param  array|mixed  $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function all($columns = ['*'])
    {
        $company_id = auth()->user()->company_id;

        return (new static)->newQuery()->where('company_id', $company_id)->get(
            is_array($columns) ? $columns : func_get_args()
        );
    }
}
