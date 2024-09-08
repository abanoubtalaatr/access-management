<?php

namespace App\Http\Queries;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RequestQueryBuilder
{
    public static function build(Builder $builder, Request $request): Builder
    {
        $filters = $request->all();
        $model = $builder->getModel();

        if ($request->has('search')) {
            $searchQuery = $request->input('search');
            $scoutBuilder = $model::search($searchQuery);

            $ids = $scoutBuilder->keys();

            $builder->whereIn($model->getQualifiedKeyName(), $ids);

            self::applyFilters($builder, $filters);

            return $builder;
        }

        self::applyFilters($builder, $filters);

        return $builder->latest();
    }

    protected static function applyFilters(Builder $builder, array $filters): void
    {
        foreach ($filters as $key => $value) {
            $method = Str::camel($key);

            if (in_array($method, get_class_methods($builder))) {
                $builder->$method($value);
            }
        }
    }
}
