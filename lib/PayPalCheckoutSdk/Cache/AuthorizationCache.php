<?php

namespace PayPalCheckoutSdk\Cache;

use PayPalCheckoutSdk\Core\AccessTokenEncrypted;

class AuthorizationCache
{
    private static $cachePath;
    
    /**
     * A pull method which would read the AccessTokenEncrypted based on a key.
     * If key is not provided, an array with all the tokens would be passed.
     *
     * @param string $key
     * @return AccessTokenEncrypted|object|null
     */
    public static function pull($key = null)
    {
        $tokens = null;
        if (self::$cachePath === null) {
            return $tokens;
        }
        if (file_exists(self::$cachePath)) {
            $cache = file_get_contents(self::$cachePath);
            if ($cache) {
                $tokens = @json_decode($cache);
            }
        }
        
        if ($key) {
            // If $key is supplied, return that data only
            return isset($tokens->{$key}) ? AccessTokenEncrypted::fromCacheData($tokens->{$key}) : null;
        }
        
        return $tokens;
    }
    
    /**
     * Persists the data into a cache file provided in $CACHE_PATH
     *
     * @param string $key the key under which the data is saved
     * @param AccessTokenEncrypted $accessTokenEncrypted
     * @throws \Exception
     */
    public static function push($key, AccessTokenEncrypted $accessTokenEncrypted)
    {
        // make sure cache dir exists
        if (self::$cachePath === null) {
            return;
        }
        
        if (!is_dir(dirname(self::$cachePath))) {
            if (mkdir(dirname(self::$cachePath), 0755, true) == false) {
                throw new \Exception("Failed to create directory at " . self::$cachePath);
            }
        }
        
        // Reads all the existing persisted data
        $tokens = self::pull() ?: (object)array();
        if (is_object($tokens)) {
            $tokens->{$key} = $accessTokenEncrypted->toCacheData();
        }
        
        if (!file_put_contents(self::$cachePath, json_encode($tokens))) {
            throw new \Exception("Failed to write cache");
        };
    }
    
    /**
     * @param string $cachePath
     */
    public static function setCachePath($cachePath)
    {
        self::$cachePath = $cachePath;
    }
}
