<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use App\Services\Filters\TaskFilter;
use App\Transformers\TaskTransformer;
use Illuminate\Http\Request;

class TaskController
{
    /**
     * @param Request $request
     * @param TaskFilter $taskFilter
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request, TaskFilter $taskFilter)
    {
        return response()->json(fractal()
            ->collection(Task::filter($taskFilter, $request->all())->get())
            ->transformWith(new TaskTransformer())
            ->toArray());
    }
}
