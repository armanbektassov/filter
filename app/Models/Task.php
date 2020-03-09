<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function createdUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function scopeFilter($query, $filter, $params)
    {
        /* @var \App\Services\Filters\TaskFilter $filter */
        return $filter->apply($query, $params);
    }
}
