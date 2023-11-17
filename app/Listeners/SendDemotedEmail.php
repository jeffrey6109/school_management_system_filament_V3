<?php

namespace App\Listeners;

use App\Events\DemoteStudent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendDemotedEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(DemoteStudent $event): void
    {
        logger('Sending email to student ' . $event->student->name);
    }
}
