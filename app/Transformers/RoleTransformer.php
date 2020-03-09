<?php

namespace App\Transformers;


use App\Models\Role;
use League\Fractal\TransformerAbstract;

class RoleTransformer extends TransformerAbstract
{
    /**
     * @param Role $model
     * @return array
     */
    public function transform(Role $model)
    {
        return [
            'id' => (int)$model->id,
            'name' => $model->name
        ];
    }
}
