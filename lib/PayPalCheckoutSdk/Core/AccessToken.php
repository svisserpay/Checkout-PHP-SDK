<?php

namespace PayPalCheckoutSdk\Core;


class AccessToken
{
    public $accessToken;
    
    public function __construct($accessToken)
    {
        $this->accessToken = $accessToken;
    }
}