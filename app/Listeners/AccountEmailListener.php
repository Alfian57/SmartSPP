<?php

namespace App\Listeners;

use App\Events\OnAccountCreated;
use App\Mail\UserRegistrationMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AccountEmailListener
{
    /**
     * Handle the event.
     */
    public function handle(OnAccountCreated $event): void
    {
        Mail::to($event->email)->queue(new UserRegistrationMail(
            $event->name,
            $event->email,
            $event->password,
        ));
    }
}
