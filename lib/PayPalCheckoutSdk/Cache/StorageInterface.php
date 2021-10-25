<?php

namespace PayPalCheckoutSdk\Cache;

interface StorageInterface
{
    /** @return string */
    public function pull();
    
    /**
     * @param string $access_token
     * @param int $expires_in
     * @return mixed
     */
    public function push($access_token, $expires_in);
}