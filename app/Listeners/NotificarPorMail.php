<?php

namespace App\Listeners;

use App\Events\ModeloEvento;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotificarPorMail
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
    public function handle(ModeloEvento $event)
    {
        echo "<div class=\"debug bg-gray-600\">Se notifica al usuario por mail</div>";
    }
}
