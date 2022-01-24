<?php

namespace App\Listeners;

use App\Events\NotifyEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotificarPorPantalla
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
     * @param  object  $event
     * @return void
     */
    public function handle(NotifyEvent $event)
    {
        echo "<div class=\"debug bg-gray-700\">Se notifica por pantalla del resultado de la operación: $event->mensaje</div>";
    }
}
