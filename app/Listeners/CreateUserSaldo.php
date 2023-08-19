<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Models\Saldo;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateUserSaldo
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\UserCreated  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        $user = $event->user;
        $saldo = 0;
        Saldo::create([
            'user_id' => $user->id,
            'saldo' => $saldo
        ]);
    }
}