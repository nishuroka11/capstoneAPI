<?php

namespace App\Responses;

use Illuminate\Http\Response;
use Laravel\Fortify\Contracts\PasswordResetResponse as PasswordResetResponseContract;

class PasswordResetResponse implements PasswordResetResponseContract
{
    public function toResponse($request)
    {
        return $request->wantsJson()
            ? new Response('', 201)
            : redirect(config('fortify.password-reset-successful'));
    }
}
