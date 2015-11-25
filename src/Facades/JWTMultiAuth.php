<?php

namespace Thefoxjob\JWTMultiAuth\Facades;

use Illuminate\Support\Facades\Facade;

class JWTMultiAuth extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'jwt.multiauth';
    }
}
