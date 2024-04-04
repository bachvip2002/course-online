<?php

namespace App\Trait;

trait FilterQueryTrait
{
    /**
     * Method scopeFindColumns
     *
     * @param \Illuminate\Database\Eloquent\Builder $query 
     * @param array $keys 
     * @param $request
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFindByFields($query, $keys, $request)
    {
        if ($key_word = $request->key_word) {
            $query->where(function ($query) use ($keys, $key_word) {
                foreach ($keys as $val) {
                    $query->orWhere($val, '=', $key_word);
                }

                $keyFind = implode(", ' ',", $keys);
                $query->orWhereRaw("concat($keyFind) = ?", [$key_word]);
            });
        }

        return $query;
    }

    /**
     * Method scopeFindStrBy
     *
     * @param \Illuminate\Database\Eloquent\Builder $query 
     * @param array $keys 
     * @param $request
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFindStrBy($query, $key, $request, $keyCustom = null)
    {
        if ($value = $request->{$keyCustom == null ? $key : $keyCustom}) {
            $query->where($key, 'LIKE', '%' . $value . '%');
        }

        return $query;
    }


    /**
     * Method scopeFindBy
     *
     * @param \Illuminate\Database\Eloquent\Builder $query 
     * @param $key $key 
     * @param $request
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFindBy($query, $key, $request, $keyCustom = null)
    {
        if ($value = $request->{$keyCustom == null ? $key : $keyCustom}) {
            $query->where($key, $value);
        }

        return $query;
    }


    /**
     * Method scopeFindInField
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $key 
     * @param $request
     * @param string $keyCustom
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFindInField($query, $key, $request, $keyCustom = null)
    {
        if ($value = $request->{$keyCustom == null ? $key : $keyCustom}) {
            $query->whereIn($key, $value);
        }

        return $query;
    }

    /**
     * Method scopeFindBetweenDateTime
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $key 
     * @param $request 
     * @param string $custom_min 
     * @param string $custom_max 
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFindBetween($query, $key, $request, $custom_min = null, $custom_max = null)
    {
        if ($value = $request->min) {
            $query->where($key, '>=', $value);
        }
        if ($value = $request->max) {
            $query->where($key, '<=', $value);
        }

        return $query;
    }

    /**
     * Method scopeFindBetweenDateTime
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $key 
     * @param $request 
     * @param string $custom_start_time 
     * @param string $custom_end_time 
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFindBetweenDateTime($query, $key, $request, $custom_start_time = null, $custom_end_time = null)
    {
        if ($start_time = $request->start_time) {
            $query->where($key, '>=', $start_time);
        }
        if ($end_time = $request->end_time) {
            $query->where($key, '<=', $end_time);
        }

        return $query;
    }
}
