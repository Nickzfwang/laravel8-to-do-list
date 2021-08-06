<?php

namespace App\Actions\Auth;

use Lorisleiva\Actions\Concerns\AsAction;

class GetUserProfile
{
    use AsAction;

    public function handle()
    {
        $user = auth()->user();

        return [
            'user' => [
                'name' => $user->name,
                'email' => $user->email
            ]
        ];
    }
}
