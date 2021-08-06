<?php

namespace App\Actions\Todo;

use App\Models\Todo;
use App\Models\User;
use App\Http\Resources\TodoResource;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateOrUpdate
{
    use AsAction;

    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255'
            ],
            'attachment' => [
                'nullable',
                'json'
            ]
        ];
    }

    public function authorize(ActionRequest $request): bool
    {
        $todo = Todo::find($request->route('todoId'));

        if ($todo) {
            return $todo->user_id === $request->user()->id;
        }

        return true;
    }

    public function handle(User $user, array $data, ?int $todoId)
    {
        $todoData = array_merge($data, [
            'user_id' => $user->id
        ]);

        $todo = Todo::with('items')->whereUserId($user->id)->find($todoId);

        if ($todo) {
            $todo->update($todoData);
            return $todo;
        }

        return $user->todos()->create($todoData);
    }

    public function asController(ActionRequest $request, ?int $todoId = null): TodoResource
    {
        $todo = $this->handle(
            $request->user(),
            $request->only('title', 'attachment'),
            $todoId
        );

        return new TodoResource($todo);
    }
}
