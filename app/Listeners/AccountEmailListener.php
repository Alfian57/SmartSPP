<?php

namespace App\Listeners;

use App\Events\OnAccountCreated;
use App\Mail\UserRegistrationMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
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
