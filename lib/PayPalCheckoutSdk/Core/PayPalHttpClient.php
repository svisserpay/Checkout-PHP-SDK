<?php

namespace PayPalCheckoutSdk\Core;

use BraintreeHttp\HttpClient;
use PayPalCheckoutSdk\Cache\StorageInterface;

class PayPalHttpClient extends HttpClient
{
    public $authInjector;

    public function __construct(PayPalEnvironment $environment, StorageInterface $storage, $bnCode = '')
    {
        parent::__construct($environment);
        
        $this->authInjector = new AuthorizationInjector($this, $environment, $storage);
        $this->addInjector($this->authInjector);
        $this->addInjector(new GzipInjector());
        $this->addInjector(new FPTIInstrumentationInjector());
        
        if (!empty($bnCode)) {
            $this->addInjector(new PartnerAttributionInjector($bnCode));
        }       
    }

    public function userAgent()
    {
        return UserAgent::getValue();
    }
}

