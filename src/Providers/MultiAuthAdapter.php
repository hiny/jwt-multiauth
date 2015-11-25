<?php

namespace Thefoxjob\JWTAuth\Providers;

use Exception;
use Illuminate\Auth\AuthManager;
use Kbwebs\MultiAuth\MultiManager;
use Tymon\JWTAuth\Providers\Auth\AuthInterface;

class MultiAuthAdapter implements AuthInterface
{
    /**
     * @var \Kbwebs\MultiAuth\MultiManager
     */
    protected $manager;

    /**
     * @var \Kbwebs\AuthManager
     */
    protected $auth;

    /**
     * @param \Kbwebs\MultiAuth\MultiManager  $manager
     */
    public function __construct(MultiManager $manager)
    {
        $this->manager = $manager;
    }

    public function setAudience($audience)
    {
        $this->auth = $this->manager->$audience();
    }

    /**
     * Check a user's credentials
     *
     * @param  array  $credentials
     * @return bool
     */
    public function byCredentials(array $credentials = [])
    {
        return $this->auth->once($credentials);
    }

    /**
     * Authenticate a user via the id
     *
     * @param  mixed  $id
     * @return bool
     */
    public function byId($id)
    {
        try {
            return $this->auth->onceUsingId($id);
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Get the currently authenticated user
     *
     * @return mixed
     */
    public function user()
    {
        return $this->auth->user();
    }

    public function auth()
    {
        return $this->auth;
    }
}
