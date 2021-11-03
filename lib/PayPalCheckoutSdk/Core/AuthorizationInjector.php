<?php

namespace PayPalCheckoutSdk\Core;

use BraintreeHttp\HttpClient;
use BraintreeHttp\HttpRequest;
use BraintreeHttp\Injector;
use PayPalCheckoutSdk\Cache\StorageInterface;

class AuthorizationInjector implements Injector
{
    /** @var HttpClient */
    private $client;

    /** @var PayPalEnvironment */
    private $environment;

    /** @var StorageInterface $storage */
    private $tokenStorage;

    /** Fixed IV Size */
    const IV_SIZE = 16;

    /**
     * AuthorizationInjector constructor.
     * @param HttpClient $client
     * @param PayPalEnvironment $environment
     * @param string $refreshToken
     */
    public function __construct(HttpClient $client, PayPalEnvironment $environment, StorageInterface $storage)
    {
        $this->client = $client;
        $this->environment = $environment;
        $this->tokenStorage = $storage;
    }

    /**
     * @param HttpRequest $request
     * @throws \Exception
     */
    public function inject($request)
    {
        if (!$this->hasAuthHeader($request) && !$this->isAuthRequest($request)) {
            $request->headers['Authorization'] = 'Bearer ' . $this->tokenStorage->pullToken();
        }
    }

    /**
     * @param $request
     * @return bool
     */
    private function isAuthRequest($request)
    {
        return $request instanceof AccessTokenRequest || $request instanceof RefreshTokenRequest;
    }

    /**
     * @param HttpRequest $request
     * @return bool
     */
    private function hasAuthHeader(HttpRequest $request)
    {
        return array_key_exists("Authorization", $request->headers);
    }

    /**
     * Encrypts the input text using the cipher key
     *
     * @param string $input
     * @return string base_64 encoded string of encrypted input
     */
    public function encrypt($input)
    {
        // Create a random IV. Not using mcrypt to generate one, as to not have a dependency on it.
        $iv = substr(uniqid("", true), 0, self::IV_SIZE);
        // Encrypt the data
        $encrypted = openssl_encrypt($input, "AES-256-CBC", $this->environment->getClientSecret(), 0, $iv);
        // Encode the data with IV as prefix
        return base64_encode($iv . $encrypted);
    }

    /**
     * Decrypts the input text from the cipher key
     *
     * @param string $input base_64 encoded string of encrypted input
     * @return string
     */
    public function decrypt($input)
    {
        // Decode the IV + data
        $input = base64_decode($input);
        // Remove the IV
        $iv = substr($input, 0, self::IV_SIZE);
        // Return Decrypted Data
        return openssl_decrypt(substr($input, self::IV_SIZE), "AES-256-CBC", $this->environment->getClientSecret(), 0, $iv);
    }
}
