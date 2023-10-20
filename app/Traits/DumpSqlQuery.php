<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait DumpSqlQuery
{
    public function scopeDdQuery(Builder $builder)
    {
        $query = str_replace('?', "'?'", $builder->toSql());
        dd( vsprintf(str_replace('?', '%s', $query), $builder->getBindings()) );
        return $this;
    }
}
