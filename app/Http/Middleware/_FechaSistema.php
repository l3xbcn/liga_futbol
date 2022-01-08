<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FechaSistema
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $now = now();
        echo "<div class=\"debug bg-gray-800\">Petición realizada el: $now</div>";
        return $next($request);
    }
}
