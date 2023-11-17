<?php

namespace App\Listeners;

use App\Events\PromoteStudent as EventsPromoteStudent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PromoteStudent
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
    public function handle(EventsPromoteStudent $event): void
    {
        $event->student->standard_id += 1;
        $event->student->save();
    }
}
