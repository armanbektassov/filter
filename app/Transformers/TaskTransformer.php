<?php

namespace App\Transformers;

use App\Models\Task;
use League\Fractal\TransformerAbstract;

class TaskTransformer extends TransformerAbstract
{
    /**
     * @param Task $model
     * @return array
     */
    public function transform(Task $model)
    {
        return [
            'id' => (int)$model->id,
            'name' => $model->name
        ];
    }
}
