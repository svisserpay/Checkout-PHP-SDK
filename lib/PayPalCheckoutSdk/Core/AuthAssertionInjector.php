<?php

namespace PayPalCheckoutSdk\Core;

use BraintreeHttp\HttpRequest;
use BraintreeHttp\Injector;
use Exception;

class AuthAssertionInjector implements Injector
{
    /** @var PayPalEnvironment */
    private $environment;

    /** @var string */
    private $payerId;

    /**
     * @param PayPalEnvironment $environment
     * @param string $payerId
     */
    public function __construct(PayPalEnvironment $environment, $payerId)
    {
        $this->environment = $environment;
        $this->payerId  = $payerId;
    }

    /**
     * @param HttpRequest $httpRequest
     * @throws Exception
     */
    public function inject($httpRequest)
    {
        $httpRequest->headers['PayPal-Auth-Assertion'] =
            base64_encode('{"alg":"none"}') . '.' .
            base64_encode('{"iss": "'. $this->environment->getClientId() .'","payer_id": "'. $this->payerId .'"}') . '.';
    }
}
