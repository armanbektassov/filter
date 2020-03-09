<?php

namespace App\Services\Filters;

use Illuminate\Database\Eloquent\Builder;

class TaskFilter extends AbstractFilter
{

    /**
     * @param $values
     */
    public function status($values)
    {
        $this->builder->whereHas('status', function (Builder $q) use ($values) {
            $q->whereIn('id', $values);
        });
    }

    /**
     * @param $values
     */
    public function assigned($values)
    {
        $this->builder->whereHas('assignedUser', function (Builder $q) use ($values) {
            $q->whereIn('id', $values);
        });
    }

    /**
     * @param $values
     */
    public function role($values)
    {
        $this->builder->whereHas('assignedUser', function (Builder $q) use ($values) {
            $q->whereIn('role_id', $values);
        });
    }

    /**
     * @param $values
     */
    public function created($values)
    {
        $this->builder->whereHas('createdUser', function (Builder $q) use ($values) {
            $q->whereIn('id', $values);
        });
    }

    /**
     * @param $value
     */
    public function deadline($value)
    {
        $this->builder->where('deadline', $value);
    }

    /**
     * @param $value
     */
    public function name($value)
    {
        $this->builder->where('name', 'like', "%$value%");
    }
}
