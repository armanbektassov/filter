<?php

namespace App\Transformers;


use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * @param User $model
     * @return array
     */
    public function transform(User $model)
    {
        return [
            'id' => (int)$model->id,
            'name' => $model->name
        ];
    }
}
