<?php

namespace PayPalCheckoutSdk\Core;

use BraintreeHttp\HttpRequest;
use BraintreeHttp\Injector;
use BraintreeHttp\HttpClient;
use PayPalCheckoutSdk\Cache\AuthorizationCache;

class AuthorizationInjector implements Injector
{
    /** @var HttpClient */
    private $client;
    
    /** @var PayPalEnvironment */
    private $environment;
    
    /** @var string */
    private $refreshToken;
    
    /** @var AccessToken */
    public $accessToken;
    
    /** Fixed IV Size */
    const IV_SIZE = 16;
    
    /**
     * AuthorizationInjector constructor.
     * @param HttpClient $client
     * @param PayPalEnvironment $environment
     * @param string $refreshToken
     */
    public function __construct(HttpClient $client, PayPalEnvironment $environment, $refreshToken)
    {
        $this->client = $client;
        $this->environment = $environment;
        $this->refreshToken = $refreshToken;
    }
    
    /**
     * @param HttpRequest $request
     * @throws \Exception
     */
    public function inject($request)
    {
        if (!$this->hasAuthHeader($request) && !$this->isAuthRequest($request)) {
            $request->headers['Authorization'] = 'Bearer ' . $this->fetchAccessToken()->accessToken;
        }
    }
    
    /**
     * @return AccessToken
     * @throws \Exception
     */
    private function fetchAccessToken()
    {
        // Check if we already have accessToken in Cache
        if ($this->accessToken && !$this->accessToken->isExpired()) {
            return $this->accessToken;
        }
        
        // grab token from cache
        $accessTokenEncrypted = AuthorizationCache::pull($this->environment->getClientId());
        if ($accessTokenEncrypted && !$accessTokenEncrypted->isExpired()) {
            return $this->accessToken = new AccessToken(
                $this->decrypt($accessTokenEncrypted->accessToken),
                $accessTokenEncrypted->tokenType,
                $accessTokenEncrypted->expiresIn,
                $accessTokenEncrypted->createDate
            );
        }
        
        // refresh token
        return $this->refreshAccessToken();
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
    
    /**
     * @return AccessToken
     * @throws \BraintreeHttp\HttpException
     * @throws \BraintreeHttp\IOException
     */
    public function refreshAccessToken()
    {
        $response = $this->client->execute(new AccessTokenRequest($this->environment, $this->refreshToken));
        $accessTokenEncrypted = new AccessTokenEncrypted(
            $this->encrypt($response->result->access_token),
            $response->result->token_type,
            $response->result->expires_in
        );
        AuthorizationCache::push($this->environment->getClientId(), $accessTokenEncrypted);
        
        return $this->accessToken = new AccessToken(
            $response->result->access_token,
            $response->result->token_type,
            $response->result->expires_in
        );
    }
}
