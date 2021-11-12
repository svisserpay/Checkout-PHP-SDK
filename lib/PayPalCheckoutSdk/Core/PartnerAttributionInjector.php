<?php

namespace PayPalCheckoutSdk\Core;

use BraintreeHttp\HttpRequest;
use BraintreeHttp\Injector;
use Exception;

class PartnerAttributionInjector implements Injector
{
    /** @var string */
    private $bnCode;

    /**
     * @param string $bnCode
     */
    public function __construct($bnCode)
    {
        $this->bnCode = $bnCode;
    }

    /**
     * @param HttpRequest $httpRequest
     * @throws Exception
     */
    public function inject($httpRequest)
    {
        $httpRequest->headers['PayPal-Partner-Attribution-Id'] = $this->bnCode;
    }
}
