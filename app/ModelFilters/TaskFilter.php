<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class TaskFilter extends ModelFilter
{

    public function title($value): TaskFilter
    {
        return $this->where('title', 'LIKE', "%$value%");
    }

    public function status($value): TaskFilter
    {
        return $this->where('status', 'LIKE', "%$value%");
    }

    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];
}
