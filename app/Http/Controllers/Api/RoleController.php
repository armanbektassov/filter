<?php

namespace App\Http\Controllers\Api;

use App\Models\Role;
use App\Transformers\RoleTransformer;

class RoleController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke()
    {
        return response()->json(fractal()
            ->collection(Role::all())
            ->transformWith(new RoleTransformer())
            ->toArray());
    }
}
