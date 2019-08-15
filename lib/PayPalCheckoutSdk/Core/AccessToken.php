<?php

namespace PayPalCheckoutSdk\Core;


class AccessToken
{
    public $accessToken;
    public $tokenType;
    public $expiresIn;
    public $createDate;
    
    /**
     * @var int $expiryBufferTime
     */
    private static $expiryBufferTime = 120;

    public function __construct($accessToken, $tokenType, $expiresIn, $createDate = null)
    {
        $this->accessToken = $accessToken;
        $this->tokenType = $tokenType;
        $this->expiresIn = $expiresIn;
        $this->createDate = $createDate ?: time();
    }

    public function isExpired()
    {
        return time() - self::$expiryBufferTime >= $this->createDate + $this->expiresIn;
    }
}