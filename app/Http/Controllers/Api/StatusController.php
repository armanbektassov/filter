<?php

namespace App\Http\Controllers\Api;

use App\Models\Status;
use App\Transformers\StatusTransformer;

class StatusController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke()
    {
        return response()->json(fractal()
            ->collection(Status::all())
            ->transformWith(new StatusTransformer())
            ->toArray());
    }
}
