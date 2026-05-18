<?php

namespace App\Support;

class StockImage
{
    /**
     * Resolve a dot-notation key (e.g. homepage.welcome.culture) to a public-relative path.
     */
    public static function path(string $key): ?string
    {
        $value = data_get(config('stock-images'), $key);

        if (! is_string($value) || $value === '') {
            return null;
        }

        return $value;
    }

    /**
     * Resolve a dot-notation key to a full asset URL, or null if not configured.
     */
    public static function url(string $key): ?string
    {
        $path = self::path($key);

        return $path ? asset($path) : null;
    }
}
