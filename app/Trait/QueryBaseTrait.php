<?php

namespace App\Trait;

trait QueryBaseTrait
{
    /**
     * Method queryBuilder
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function queryBuilder()
    {
        return $this->query()->getQuery();
    }

    /**
     * Method queryBuilder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function queryEloquentBuilder()
    {
        return $this->query();
    }
}
