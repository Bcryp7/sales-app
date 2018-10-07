<?php

namespace App\Filters;


class CategoryFilters extends Filters
{

    protected $filters = ['active']; // Add your new filter here and create a method for it and it will work ['filter1', 'filter2']

    /**
     * @param $status
     * @return mixed
     */
    protected function active($status)
    {
        return $this->builder->whereStatus($status);
    }

}
