<?php

namespace App\Listeners\User;

use App\Events\User\SendEmailVerificationCodeEvent;
use App\Mail\SendEmailVerificationCode;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailVerificationCodeEventListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(SendEmailVerificationCodeEvent $event)
    {
        $user = $event->user;
        Mail::to($user)->send(new SendEmailVerificationCode($user));
    }
}
