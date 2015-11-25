<?php

namespace Thefoxjob\JWTMultiAuth;

use Tymon\JWTAuth\JWTAuth;

class JWTMultiAuth extends JWTAuth
{
    public function fromUser($user, array $claims = array())
    {
        $this->setAudienceFromClaims($claims);
        return parent::fromUser($user, $claims);
    }

    public function attempt(array $credentials = [], array $claims = array())
    {
        $this->setAudienceFromClaims($claims);
        return parent::attempt($credentials, $claims);
    }

    public function authenticate($token = false)
    {
        $audience = $this->getPayload($token)->get('aud');
        $this->auth->setAudience($audience);
        return parent::authenticate($token);
    }

    protected function setAudienceFromClaims(array $claims)
    {
        $audience = array_get($claims, 'aud');
        $this->auth->setAudience($audience);
    }
}
