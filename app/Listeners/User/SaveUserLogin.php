<?php

namespace App\Listeners\User;

use App\Events\User\UserLoggedIn;
use User\Models\UserLogin;

class SaveUserLogin
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
     * @param  UserLoggedIn  $event
     * @return void
     */
    public function handle(UserLoggedIn $event)
    {
        UserLogin::create([
            'user_id'=> $event->user->id,
        ]);    }
}
