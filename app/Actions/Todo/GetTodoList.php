<?php

namespace App\Actions\Todo;

use App\Models\Todo;
use App\Http\Resources\TodoResource;
use Lorisleiva\Actions\Concerns\AsAction;

class GetTodoList
{
    use AsAction;

    public function handle(?int $todoId = null)
    {
        $user = auth()->user();

        $data = $todoId ? Todo::with('items')->where('id', $todoId) : Todo::with('items');

        return TodoResource::collection($data->get());
    }
}
