<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserRegistred
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $email;
    /**
     * Create a new event instance.
     */
    public function __construct(string $email)
    {
        $this->email = $email;
    }

}
