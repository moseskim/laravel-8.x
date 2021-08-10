<?php
declare(strict_types=1);

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use App\Jobs\SendRegistMail;

class RegisteredListener
{
    /**
     * Handle the event.
     *
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        dispatch(new SendRegistMail($event->user->email))
            ->onQueue("mail")
            ->delay(now()->addHour(1));
    }
}
