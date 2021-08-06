<?php

namespace App\Actions\Todo;

use App\Models\Todo;
use App\Models\TodoItem;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteTodoList
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

    public function handle(?int $todoId = null)
    {
        $user = auth()->user();

        TodoItem::where('todo_id', $todoId)->delete();

        return $todoId ? Todo::whereUserId($user->id)->where('id', $todoId)->delete() : Todo::whereUserId($user->id)->delete();
    }
}
