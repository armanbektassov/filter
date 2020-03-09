<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Transformers\UserTransformer;

class UserController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke()
    {
        return response()->json(fractal()
            ->collection(User::all())
            ->transformWith(new UserTransformer())
            ->toArray());
    }
}
