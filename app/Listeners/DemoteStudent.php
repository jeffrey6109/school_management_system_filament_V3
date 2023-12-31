<?php

namespace App\Listeners;

use App\Events\DemoteStudent as EventsDemoteStudent;

class DemoteStudent
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
    public function handle(EventsDemoteStudent $event): void
    {
        $event->student->standard_id -= 1;
        $event->student->save();
    }
}
