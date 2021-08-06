<?php

namespace App\Actions\Todo\Item;

use App\Models\Todo;
use App\Http\Resources\TodoItemResource;
use Lorisleiva\Actions\Concerns\AsAction;

class GetTodoItem
{
    use AsAction;

    public function handle(int $todoId)
    {
        $user = auth()->user();

        $data = Todo::with('items')->where('id', $todoId)->first();

        return response()->json($data);
    }
}
