<?php

namespace App\Transformers;

use App\Models\Status;
use League\Fractal\TransformerAbstract;

class StatusTransformer extends TransformerAbstract
{
    /**
     * @param Status $model
     * @return array
     */
    public function transform(Status $model)
    {
        return [
            'id' => (int)$model->id,
            'name' => $model->name
        ];
    }
}
