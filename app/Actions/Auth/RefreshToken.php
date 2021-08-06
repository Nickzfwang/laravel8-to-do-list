<?php

namespace App\Actions\Auth;

use Lorisleiva\Actions\Concerns\AsAction;

class RefreshToken
{
    use AsAction;

    public function handle()
    {
        $token = auth()->refresh();

        return [
            'access_token' => $token
        ];
    }
}
