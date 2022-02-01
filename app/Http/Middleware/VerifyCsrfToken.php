<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'player/destroy',
        'player/update',
        'player/store',
        'team/destroy',
        'team/update',
        'team/store',        
        'game/destroy',
        'game/update',
        'game/store',
        'login',
    ];
}
