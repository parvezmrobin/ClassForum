<?php

namespace app\Filters;

use Illuminate\Http\Request;

abstract class Filters
{
    protected $request;
    protected $filters = [];

    protected $builder;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function apply($builder)
    {
        $this->builder = $builder;

        foreach ($this->getFilters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }

        return $this->builder;
    }

    public function getFilters()
    {
        return $this->request->intersect($this->filters);
    }

}