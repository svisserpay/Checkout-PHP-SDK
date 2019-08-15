<?php

namespace PayPalCheckoutSdk\Core;


use stdClass;

class AccessTokenEncrypted extends AccessToken
{
    /**
     * Uses the keys from paypal/rest-api-sdk-php's AuthorizationCache for interoperability.
     *
     * @return stdClass
     */
    public function toCacheData()
    {
        return (object)array(
            'accessTokenEncrypted' => $this->accessToken,
            'tokenType' => $this->tokenType,
            'tokenExpiresIn' => $this->expiresIn,
            'tokenCreateTime' => $this->createDate,
        );
    }
    
    /**
     * @param stdClass $json
     * @return AccessTokenEncrypted|null
     */
    public static function fromCacheData($json)
    {
        return new self(
            $json->accessTokenEncrypted,
            $json->tokenType,
            $json->tokenExpiresIn,
            $json->tokenCreateTime
        );
    }
}