<?php

namespace PayPalCheckoutSdk\Cache;

interface StorageInterface
{
    /** @return string */
    public function pullToken($forceRefresh = false);
}