<?php

namespace App\Trait;

trait QueryBaseStaticTrait
{
    /**
     * Method service
     *
     * @return static
     */
    public static function service()
    {
        return new static();
    }

    /**
     * Method queryBuilder
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public static function queryBuilder()
    {
        return static::query()->getQuery();
    }

    /**
     * Method queryBuilder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function queryEloquentBuilder()
    {
        return static::query();
    }
}
