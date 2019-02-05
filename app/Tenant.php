<?php

namespace App;

use Illuminate\Database\Eloquent\{Builder, Model};

trait Tenant
{
    public function scopePerCompany($query) 
    {
        return $query->where('company_id', auth()->user()->company_id);
    }

    public function scopeRender($query) 
    {
        $limit = request('limit', 10);
        $offset = request('offset', 0);

        return $query->when(request('sort'), function($query, $sort) {
                        $query->orderBy($sort, request('order'));
                     })
                     ->limit($limit)
                     ->offset($offset);
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
}
