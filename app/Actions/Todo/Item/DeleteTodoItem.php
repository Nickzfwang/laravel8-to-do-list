<?php

namespace App\Actions\Todo\Item;

use App\Models\Todo;
use App\Models\TodoItem;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteTodoItem
{
    use AsAction;

    public function authorize(ActionRequest $request): bool
    {
        $todo = Todo::find($request->route('todoId'));

        if ($todo) {
            return $todo->user_id === $request->user()->id;
        }

        return true;
    }

    public function handle(int $todoId, ?int $itemId = null)
    {
        $user = auth()->user();

        return TodoItem::where('id', $itemId)->delete();
    }
}
