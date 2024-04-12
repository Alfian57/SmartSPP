<?php

namespace App\Listeners;

use App\Events\OnAccountCreated;

class AccountCreationListener
{
    /**
     * Handle the event.
     */
    public function handle(OnAccountCreated $event): void
    {
        $event->user->account()->create([
            'email' => $event->email,
            'password' => $event->password,
        ]);
    }
}
