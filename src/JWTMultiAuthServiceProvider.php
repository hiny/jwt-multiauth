<?php

namespace Thefoxjob\JWTMultiAuth;

use Illuminate\Support\ServiceProvider;

class JWTMultiAuthServiceProvider extends ServiceProvider
{
    protected $defer = false;

    public function boot()
    {
    }

    public function register()
    {
        $this->app['jwt.multiauth'] = $this->app->share(function ($app) {
            $auth = new JWTMultiAuth(
                $app['tymon.jwt.manager'],
                $app['tymon.jwt.provider.user'],
                $app['tymon.jwt.provider.auth'],
                $app['request']
            );

            return $auth->setIdentifier($this->config('identifier'));
        });
    }

    /**
     * Helper to get the config values
     *
     * @param  string $key
     * @return string
     */
    protected function config($key, $default = null)
    {
        return config("jwt.$key", $default);
    }
}
