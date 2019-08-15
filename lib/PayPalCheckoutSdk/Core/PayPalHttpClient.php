<?php

namespace PayPalCheckoutSdk\Core;

use BraintreeHttp\HttpClient;
use PayPalCheckoutSdk\Cache\AuthorizationCache;

class PayPalHttpClient extends HttpClient
{
    private $refreshToken;
    public $authInjector;

    public function __construct(PayPalEnvironment $environment, $refreshToken = NULL)
    {
        parent::__construct($environment);
        $this->refreshToken = $refreshToken;
        $this->authInjector = new AuthorizationInjector($this, $environment, $refreshToken);
        $this->addInjector($this->authInjector);
        $this->addInjector(new GzipInjector());
        $this->addInjector(new FPTIInstrumentationInjector());
    }

    public function userAgent()
    {
        return UserAgent::getValue();
    }
    
    public function setCachePath($strCachePath)
    {
        AuthorizationCache::setCachePath($strCachePath);
    }
}

