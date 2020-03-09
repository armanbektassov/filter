<?php

namespace App\Services\Filters;


abstract class AbstractFilter
{

    /**
     * @var
     */
    public $builder;

    /**
     * @param $builder
     * @param $params
     * @return mixed
     */
    public function apply($builder, $params)
    {
        $this->builder = $builder;
        foreach ($params as $param => $value) {
            if (method_exists($this, $param) && $value) {
                $this->$param($value);
            }
        }

        return $this->builder;
    }
}
