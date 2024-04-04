<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Query\Builder;

class QueryBuilderProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services query custom.
     *
     * @return void
     */
    public function boot()
    {
        Builder::macro(
            'findStrBy',
            function ($key, $request, $keyCustom = null) {
                /** @var \Illuminate\Database\Query\Builder $this  */
                if ($value = $request->{$keyCustom == null ? $key : $keyCustom}) {
                    return $this->where($key, 'LIKE', '%' . $value . '%');
                }

                return $this;
            }
        );

        Builder::macro(
            'findBy',
            function ($key, $request, $keyCustom = null) {
                /** @var \Illuminate\Database\Query\Builder $this  */
                if ($value = $request->{$keyCustom == null ? $key : $keyCustom}) {
                    return $this->where($key, $value);
                };

                return $this;
            }
        );

        Builder::macro(
            'findInField',
            function ($key, $request, $keyCustom = null) {
                /** @var \Illuminate\Database\Query\Builder $this  */
                if ($value = $request->{$keyCustom == null ? $key : $keyCustom}) {
                    return $this->whereIn($key, $value);
                }

                return $this;
            }
        );

        Builder::macro(
            'findBetween',
            function ($key, $request, $custom_min = null, $custom_max = null) {
                /** @var \Illuminate\Database\Query\Builder $this  */
                if ($value = $request->min) {
                    return $this->where($key, '>=', $value);
                }
                if ($value = $request->max) {
                    return $this->where($key, '<=', $value);
                }

                return $this;
            }
        );

        Builder::macro(
            'findBetweenDateTime',
            function ($key, $request, $custom_start_time = null, $custom_end_time = null) {
                /** @var \Illuminate\Database\Query\Builder $this  */
                if ($start_time = $request->start_time) {
                    $this->where($key, '>=', $start_time);
                }
                if ($end_time = $request->end_time) {
                    $this->where($key, '<=', $end_time);
                }

                return $this;
            }
        );
    }
}
