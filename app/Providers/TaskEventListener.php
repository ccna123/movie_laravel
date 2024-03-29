<?php

namespace App\Providers;

use App\Providers\TaskEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TaskEventListener
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
     * @param  \App\Providers\TaskEvent  $event
     * @return void
     */
    public function handle(TaskEvent $event)
    {
        return $event;
    }
}
