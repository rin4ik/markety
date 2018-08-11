<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class ProductFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function categoryId($categoryId)
    {
        if (!$categoryId) {
            return;
        }

        return $this->where('category_id', $categoryId);
    }

    public function brands($brands)
    {
        if (!$brands) {
            return;
        }
        return $this->whereIn('manufacturer_id', $brands);
    }
}
