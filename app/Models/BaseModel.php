<?php

namespace App\Models;

use App\Trait\FilterQueryTrait;
use App\Trait\QueryBaseStaticTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use HasFactory,
        FilterQueryTrait,
        QueryBaseStaticTrait;

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
