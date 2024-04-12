<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class OnAccountCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $name;

    public string $email;

    public string $password;

    public $user;

    /**
     * Create a new event instance.
     */
    public function __construct($name, $email, $user, $password = null)
    {
        $this->name = $name;
        $this->email = $email;
        $this->user = $user;

        if ($password == null) {
            $this->password = Str::random(8);
        }
    }
}
